<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutletResource\Pages;
use App\Models\Outlet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OutletResource extends Resource
{
    protected static ?string $model = Outlet::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Data Outlet';
    protected static ?string $modelLabel = 'Outlet';
    protected static ?string $pluralModelLabel = 'Data Outlet';
    protected static ?string $navigationGroup = 'Manajemen Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Outlet')
                    ->description('Kelola data toko atau klien')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Toko/Klien')
                                    ->placeholder('Masukkan nama toko atau klien')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('phone_number')
                                    ->label('Nomor Telepon')
                                    ->placeholder('Contoh: 08123456789')
                                    ->tel()
                                    ->maxLength(255),
                            ]),

                        Forms\Components\Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->placeholder('Masukkan alamat lengkap')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Pengaturan Lokasi GPS')
                    ->description('Wajib diisi agar Sales bisa melakukan laporan kunjungan dengan validasi jarak (Geofencing).')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->placeholder('Contoh: -0.025994')
                                    ->numeric()
                                    ->required()
                                    ->helperText('Gunakan tanda minus (-) jika perlu.'),

                                Forms\Components\TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->placeholder('Contoh: 109.340556')
                                    ->numeric()
                                    ->required(),

                                Forms\Components\TextInput::make('radius_meters')
                                    ->label('Radius (Meter)')
                                    ->numeric()
                                    ->default(50)
                                    ->minValue(10)
                                    ->maxValue(1000)
                                    ->required()
                                    ->helperText('Rekomendasi: 50–100m.'),
                            ]),

                        Forms\Components\Placeholder::make('preview_map')
                            ->label('Preview Lokasi di Peta')
                            ->columnSpanFull()
                            ->content(function ($record) {
                                if (! $record || ! $record->latitude || ! $record->longitude) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<p class="text-sm text-gray-500">Koordinat belum diisi. Preview peta akan muncul setelah koordinat tersimpan.</p>'
                                    );
                                }
                                $lat = $record->latitude;
                                $lng = $record->longitude;
                                return new \Illuminate\Support\HtmlString("
                                    <iframe width='100%' height='280' frameborder='0'
                                        style='border-radius: 12px; border: 1px solid #e5e7eb;'
                                        src='https://maps.google.com/maps?q={$lat},{$lng}&hl=id&z=17&output=embed'>
                                    </iframe>
                                ");
                            })
                            ->visible(fn ($record) => $record !== null),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Toko')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('phone_number')
                    ->label('No. Telepon')
                    ->searchable()
                    ->icon('heroicon-o-phone'),

                Tables\Columns\IconColumn::make('latitude')
                    ->label('Status GPS')
                    ->boolean()
                    ->getStateUsing(fn ($record): bool => filled($record->latitude) && filled($record->longitude))
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->tooltip('Centang hijau berarti GPS siap untuk Geofencing'),

                Tables\Columns\TextColumn::make('radius_meters')
                    ->label('Radius')
                    ->suffix(' m')
                    ->badge()
                    ->color('info')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Didaftarkan Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->tooltip('Edit data outlet'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ])
            ->emptyStateHeading('Belum ada data outlet')
            ->emptyStateDescription('Mulai tambahkan outlet untuk memudahkan pencatatan kunjungan.')
            ->emptyStateIcon('heroicon-o-building-storefront');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOutlets::route('/'),
            'create' => Pages\CreateOutlet::route('/create'),
            'edit'   => Pages\EditOutlet::route('/{record}/edit'),
        ];
    }
}