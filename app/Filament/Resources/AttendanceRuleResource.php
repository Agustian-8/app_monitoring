<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceRuleResource\Pages;
use App\Models\AttendanceRule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AttendanceRuleResource extends Resource
{
    protected static ?string $model = AttendanceRule::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Kebijakan Absensi';
    protected static ?string $modelLabel = 'Kebijakan Absensi';
    protected static ?string $pluralModelLabel = 'Kebijakan Absensi';
    protected static ?string $navigationGroup = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kode')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('kode')
                                    ->label('Kode')
                                    ->required()
                                    ->maxLength(10)
                                    ->disabled(fn (string $context) => $context === 'edit')
                                    ->dehydrated(),

                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\Select::make('kategori')
                                    ->label('Kategori')
                                    ->options([
                                        'hadir'     => 'Hadir',
                                        'terlambat' => 'Terlambat',
                                        'absen'     => 'Absen',
                                        'izin'      => 'Izin',
                                        'cuti'      => 'Cuti',
                                        'khusus'    => 'Khusus',
                                    ])
                                    ->required(),
                            ]),

                        Forms\Components\Textarea::make('penjelasan')
                            ->label('Penjelasan Detail')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Sanksi & Dampak')
                    ->schema([
                        Forms\Components\TextInput::make('denda')
                            ->label('Denda (Rupiah)')
                            ->numeric()
                            ->default(0)
                            ->prefix('Rp'),

                        Forms\Components\Toggle::make('potong_upah')->label('Potong Upah Pokok'),
                        Forms\Components\Toggle::make('potong_tunjangan')->label('Potong Tunjangan Harian'),
                        Forms\Components\Toggle::make('potong_hak_cuti')->label('Potong Hak Cuti Tahunan'),
                        Forms\Components\Toggle::make('tetap_dapat_upah')->label('Tetap Dapat Upah'),
                        Forms\Components\Toggle::make('tetap_dapat_tunjangan')->label('Tetap Dapat Tunjangan'),
                    ])->columns(2),

                Forms\Components\Section::make('Pengaturan Lain')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
                        Forms\Components\TextInput::make('urutan')->label('Urutan Tampil')->numeric()->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->badge()
                    ->color('primary')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('label')
                    ->label('Keterangan')
                    ->searchable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('penjelasan')
                    ->label('Penjelasan')
                    ->limit(60)
                    ->tooltip(fn ($state) => $state)
                    ->wrap()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'hadir'     => 'success',
                        'terlambat' => 'warning',
                        'absen'     => 'danger',
                        'izin'      => 'info',
                        'cuti'      => 'primary',
                        'khusus'    => 'gray',
                        default     => 'gray',
                    }),

                Tables\Columns\TextColumn::make('denda_rupiah')
                    ->label('Denda')
                    ->badge()
                    ->color(fn ($record) => $record->denda > 0 ? 'danger' : 'gray')
                    ->getStateUsing(fn ($record) => $record->denda_rupiah),

                Tables\Columns\TextColumn::make('dampak')
                    ->label('Dampak Upah/Tunjangan')
                    ->badge()
                    ->color('warning')
                    ->getStateUsing(fn ($record) => $record->dampak)
                    ->wrap()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
            ])
            ->defaultSort('urutan', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'hadir'     => 'Hadir',
                        'terlambat' => 'Terlambat',
                        'absen'     => 'Absen',
                        'izin'      => 'Izin',
                        'cuti'      => 'Cuti',
                        'khusus'    => 'Khusus',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square'),
            ])
            ->bulkActions([])
            ->paginated(false)
            ->emptyStateHeading('Belum ada kebijakan absensi')
            ->emptyStateDescription('Jalankan seeder AttendanceRuleSeeder untuk mengisi default.');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendanceRules::route('/'),
            'edit'  => Pages\EditAttendanceRule::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}