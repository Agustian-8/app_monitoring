<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Rekap Absensi';
    protected static ?string $modelLabel = 'Absensi';
    protected static ?string $pluralModelLabel = 'Data Absensi';
    protected static ?string $navigationGroup = 'Laporan Harian';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kehadiran')
                    ->description('Isi data kehadiran pegawai dengan lengkap')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Nama Pegawai')
                            ->searchable()
                            ->preload()
                            ->placeholder('Pilih pegawai')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('tipe_absen')
                                    ->label('Tipe Absen')
                                    ->options([
                                        'Masuk'  => 'Masuk',
                                        'Pulang' => 'Pulang',
                                    ])
                                    ->required(),

                                Forms\Components\Select::make('kode_absen')
                                    ->label('Kode Absensi')
                                    ->options(function () {
                                        $options = [];
                                        foreach (Attendance::getKodeList() as $kode => $info) {
                                            $options[$kode] = "{$kode} — {$info['label']}";
                                        }
                                        return $options;
                                    })
                                    ->searchable()
                                    ->placeholder('Pilih kode absensi')
                                    ->required(),
                            ]),

                        Forms\Components\FileUpload::make('photo_path')
                            ->label('Foto/Bukti')
                            ->disk('public')
                            ->image()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('notes')
                            ->label('Keterangan Tambahan')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereIn('id', function (\Illuminate\Database\Query\Builder $sub) {
                    $sub->selectRaw('MIN(id)')
                        ->from('attendances')
                        ->groupBy('user_id', DB::raw('DATE(created_at)'));
                });
            })
            ->columns([
                Tables\Columns\ImageColumn::make('photo_path')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->size(50)
                    ->extraImgAttributes(['class' => 'cursor-pointer hover:opacity-75 transition-opacity duration-200'])
                    ->action(
                        Tables\Actions\Action::make('zoom_foto')
                            ->modalHeading('Detail Foto Absensi')
                            ->modalContent(fn ($record) => new \Illuminate\Support\HtmlString(
                                $record->photo_path
                                    ? '<div class="flex justify-center"><img src="' . asset('storage/' . $record->photo_path) . '" alt="Foto" style="max-height: 70vh; width: auto; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" /></div>'
                                    : '<p class="text-center text-gray-500">Tidak ada foto.</p>'
                            ))
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Tutup')
                    )
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pegawai')
                    ->description(fn ($record) => $record->user->department ?? '-')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('jam_masuk')
                    ->label('Jam Masuk')
                    ->badge()
                    ->color('success')
                    ->alignCenter()
                    ->getStateUsing(function ($record) {
                        $masuk = Attendance::where('user_id', $record->user_id)
                            ->whereDate('created_at', $record->created_at->format('Y-m-d'))
                            ->where('tipe_absen', 'Masuk')
                            ->first();
                        return $masuk ? $masuk->created_at->format('H:i') : '-';
                    }),

                Tables\Columns\TextColumn::make('jam_pulang')
                    ->label('Jam Pulang')
                    ->badge()
                    ->color('danger')
                    ->alignCenter()
                    ->getStateUsing(function ($record) {
                        $pulang = Attendance::where('user_id', $record->user_id)
                            ->whereDate('created_at', $record->created_at->format('Y-m-d'))
                            ->where('tipe_absen', 'Pulang')
                            ->first();
                        return $pulang ? $pulang->created_at->format('H:i') : '-';
                    }),

                Tables\Columns\TextColumn::make('kode_absen_harian')
                    ->label('Kode Absen')
                    ->badge()
                    ->alignCenter()
                    ->getStateUsing(function ($record) {
                        $masuk = Attendance::where('user_id', $record->user_id)
                            ->whereDate('created_at', $record->created_at->format('Y-m-d'))
                            ->where('tipe_absen', 'Masuk')
                            ->first();
                        return $masuk?->kode_absen ?? $masuk?->status ?? $record->status ?? '-';
                    })
                    ->tooltip(function ($state) {
                        $info = Attendance::getKodeInfo($state);
                        return $info ? $info['label'] : $state;
                    })
                    ->color(fn ($state) => Attendance::getKodeColor($state))
                    ->icon(fn ($state) => Attendance::getKodeIcon($state)),

                Tables\Columns\TextColumn::make('menit_telat_harian')
                    ->label('Telat')
                    ->badge()
                    ->alignCenter()
                    ->getStateUsing(function ($record) {
                        $masuk = Attendance::where('user_id', $record->user_id)
                            ->whereDate('created_at', $record->created_at->format('Y-m-d'))
                            ->where('tipe_absen', 'Masuk')
                            ->first();
                        return $masuk?->menit_telat ?? 0;
                    })
                    ->formatStateUsing(fn ($state) => $state > 0 ? "{$state} mnt" : '-')
                    ->color(fn ($state) => $state > 0 ? 'danger' : 'gray')
                    ->icon(fn ($state) => $state > 0 ? 'heroicon-o-exclamation-triangle' : null)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('menit_lembur_harian')
                    ->label('Lembur')
                    ->badge()
                    ->alignCenter()
                    ->getStateUsing(function ($record) {
                        $pulang = Attendance::where('user_id', $record->user_id)
                            ->whereDate('created_at', $record->created_at->format('Y-m-d'))
                            ->where('tipe_absen', 'Pulang')
                            ->first();
                        return $pulang?->menit_lembur ?? 0;
                    })
                    ->formatStateUsing(fn ($state) => $state > 0 ? "{$state} mnt" : '-')
                    ->color(fn ($state) => $state > 0 ? 'success' : 'gray')
                    ->icon(fn ($state) => $state > 0 ? 'heroicon-o-clock' : null)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('keterangan_gabungan')
                    ->label('Keterangan')
                    ->words(6)
                    ->tooltip(fn ($state) => $state)
                    ->getStateUsing(function ($record) {
                        $masuk = Attendance::where('user_id', $record->user_id)
                            ->whereDate('created_at', $record->created_at->format('Y-m-d'))
                            ->where('tipe_absen', 'Masuk')
                            ->first();
                        $pulang = Attendance::where('user_id', $record->user_id)
                            ->whereDate('created_at', $record->created_at->format('Y-m-d'))
                            ->where('tipe_absen', 'Pulang')
                            ->first();

                        $ket = [];
                        if ($masuk && $masuk->notes) $ket[] = $masuk->notes;
                        if ($pulang && $pulang->notes && $pulang->notes !== ($masuk->notes ?? null)) $ket[] = $pulang->notes;

                        return count($ket) > 0 ? implode(' | ', $ket) : '-';
                    })
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('kode_absen')
                    ->label('Kode Absensi')
                    ->options(function () {
                        $options = [];
                        foreach (Attendance::getKodeList() as $kode => $info) {
                            $options[$kode] = "{$kode} — {$info['label']}";
                        }
                        return $options;
                    })
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['value'])) {
                            return $query->where('kode_absen', $data['value']);
                        }
                        return $query;
                    }),

                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'hadir'     => 'Hadir',
                        'terlambat' => 'Terlambat',
                        'absen'     => 'Absen',
                        'izin'      => 'Izin',
                        'cuti'      => 'Cuti',
                        'khusus'    => 'Khusus',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (empty($data['value'])) return $query;
                        $kodeList = [];
                        foreach (Attendance::getKodeList() as $kode => $info) {
                            if (($info['kategori'] ?? null) === $data['value']) {
                                $kodeList[] = $kode;
                            }
                        }
                        return $query->whereIn('kode_absen', $kodeList);
                    }),

                Tables\Filters\Filter::make('telat')
                    ->label('Hanya Yang Telat')
                    ->query(fn (Builder $query) => $query->where('menit_telat', '>', 0)),

                Tables\Filters\Filter::make('lembur')
                    ->label('Hanya Yang Lembur')
                    ->query(fn (Builder $query) => $query->where('menit_lembur', '>', 0)),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'], fn (Builder $q, $d) => $q->whereDate('created_at', '>=', $d))
                            ->when($data['created_until'], fn (Builder $q, $d) => $q->whereDate('created_at', '<=', $d));
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->label('View')->color('gray'),
                    Tables\Actions\EditAction::make()->label('Edit')->color('warning'),
                    Tables\Actions\DeleteAction::make()->label('Hapus')->color('danger'),
                ])
                ->label('Aksi')
                ->icon('heroicon-o-ellipsis-vertical')
                ->color('gray')
                ->button()
                ->size('sm'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus Terpilih'),

                    Tables\Actions\BulkAction::make('export_custom')
                        ->label('Export Excel')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            return \Maatwebsite\Excel\Facades\Excel::download(
                                new \App\Exports\AttendanceCustomExport($records),
                                'Rekap-Absensi_' . now()->format('M-Y') . '.xlsx'
                            );
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->emptyStateHeading('Belum ada data absensi')
            ->emptyStateDescription('Data absensi akan muncul otomatis dari aplikasi sales.')
            ->emptyStateIcon('heroicon-o-clipboard-document-check');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit'   => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}