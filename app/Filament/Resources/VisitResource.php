<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitResource\Pages;
use App\Models\Visit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\VisitCustomExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Collection;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationLabel = 'Rekap Kunjungan';
    protected static ?string $modelLabel = 'Kunjungan';
    protected static ?string $pluralModelLabel = 'Data Kunjungan';
    protected static ?string $navigationGroup = 'Laporan Harian';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo_path')
                    ->label('Foto Kunjungan')
                    ->disk('public')
                    ->image()
                    ->columnSpanFull(),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Nama Sales'),

                Forms\Components\Select::make('outlet_id')
                    ->relationship('outlet', 'name')
                    ->label('Toko/Klien'),

                Forms\Components\Placeholder::make('peta_lokasi')
                    ->label('Peta Lokasi GPS')
                    ->columnSpanFull()
                    ->content(function ($record) {
                        if (! $record || ! $record->latitude || ! $record->longitude) {
                            return 'Kordinat tidak tersedia.';
                        }
                        $lat = $record->latitude;
                        $lng = $record->longitude;
                        return new \Illuminate\Support\HtmlString("
                            <iframe width='100%' height='350' frameborder='0' scrolling='no'
                                marginheight='0' marginwidth='0'
                                src='https://maps.google.com/maps?q={$lat},{$lng}&hl=id&z=17&output=embed'
                                class='rounded-xl shadow-sm border border-gray-300'></iframe>
                        ");
                    }),

                Forms\Components\Textarea::make('notes')
                    ->label('Catatan Kunjungan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo_path')
                    ->label('Foto')
                    ->disk('public')
                    ->square()
                    ->size(60)
                    ->extraImgAttributes(['class' => 'cursor-pointer hover:opacity-75 transition-opacity duration-200'])
                    ->action(
                        Tables\Actions\Action::make('zoom_foto')
                            ->modalHeading('Detail Foto Kunjungan')
                            ->modalContent(fn ($record) => new \Illuminate\Support\HtmlString('
                                <div class="flex justify-center">
                                    <img src="' . asset('storage/' . $record->photo_path) . '" alt="Foto Kunjungan" style="max-height: 70vh; width: auto; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" />
                                </div>
                            '))
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Tutup')
                    )
                    ->toggleable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Sales')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('outlet.name')
                    ->label('Toko/Klien')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Kunjungan')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Catatan')
                    ->limit(50)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('latitude')
                    ->label('Latitude')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('longitude')
                    ->label('Longitude')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Filter Sales')
                    ->relationship('user', 'name'),

                Tables\Filters\SelectFilter::make('outlet_id')
                    ->label('Filter Outlet')
                    ->relationship('outlet', 'name'),

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
                    Tables\Actions\ViewAction::make()->label('View')->color('gray')->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make()->label('Edit')->color('warning')->icon('heroicon-o-pencil-square'),
                    Tables\Actions\DeleteAction::make()->label('Hapus')->color('danger')->icon('heroicon-o-trash'),
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
                        ->action(function (Collection $records) {
                            return Excel::download(
                                new VisitCustomExport($records),
                                'Rekap_Kunjungan_' . now()->format('m-Y') . '.xlsx'
                            );
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->emptyStateHeading('Belum ada data kunjungan')
            ->emptyStateDescription('Mulai rekap kunjungan dengan menambahkan data kunjungan sales.')
            ->emptyStateIcon('heroicon-o-camera');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisits::route('/'),
        ];
    }
}