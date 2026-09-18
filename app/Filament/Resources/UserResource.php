<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Data Karyawan';
    protected static ?string $modelLabel = 'Karyawan';
    protected static ?string $pluralModelLabel = 'Data Karyawan';
    protected static ?string $navigationGroup = 'Manajemen Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun Pegawai')
                    ->description('Masukkan data pegawai yang akan menggunakan aplikasi')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('no_hp')
                            ->label('Nomor Handphone (Untuk Login)')
                            ->tel()
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: 08123456789')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email (Opsional)')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->placeholder('nama@email.com')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('department')
                            ->label('Departemen / Jabatan')
                            ->placeholder('Contoh: HRD Manager, HRD, TAS, Keuangan, Gudang')
                            ->helperText('Untuk HRD, bisa diisi "HRD Manager" atau "HRD" (staff).')
                            ->maxLength(255),

                        Forms\Components\Select::make('role')
                            ->label('Hak Akses Sistem')
                            ->options([
                                'admin'    => 'Admin / HRD (Akses panel web + mobile)',
                                'karyawan' => 'Karyawan (Hanya akses aplikasi mobile)',
                            ])
                            ->default('karyawan')
                            ->required()
                            ->helperText('Admin HRD bisa akses panel web ini. Karyawan hanya akses aplikasi di HP.')
                            ->searchable(),

                        Forms\Components\Select::make('tipe_karyawan')
                            ->label('Tipe Karyawan')
                            ->options([
                                'kantor'   => 'Karyawan Kantor (Tidak perlu kunjungan)',
                                'lapangan' => 'Sales / Lapangan (Perlu kunjungan outlet)',
                            ])
                            ->default('kantor')
                            ->required()
                            ->helperText('Menentukan apakah pegawai perlu akses fitur kunjungan.'),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->minLength(6)
                            ->placeholder(fn (string $context): string => $context === 'create'
                                ? 'Masukkan password awal'
                                : 'Kosongkan jika tidak ingin ganti password'
                            )
                            ->helperText('Minimal 6 karakter. Untuk ganti password, gunakan tombol "Reset Password" di tabel.')
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pegawai')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Nomor HP')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Nomor HP disalin'),

                Tables\Columns\TextColumn::make('department')
                    ->label('Departemen / Jabatan')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('role')
                    ->label('Hak Akses')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin'    => 'Admin / HRD',
                        'karyawan' => 'Karyawan',
                        default    => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'admin'    => 'success',
                        'karyawan' => 'info',
                        default    => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'admin'    => 'heroicon-o-shield-check',
                        'karyawan' => 'heroicon-o-user',
                        default    => null,
                    }),

                Tables\Columns\TextColumn::make('tipe_karyawan')
                    ->label('Tipe Karyawan')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'kantor'   => 'Kantor',
                        'lapangan' => 'Lapangan',
                        default    => '-',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'kantor'   => 'warning',
                        'lapangan' => 'primary',
                        default    => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'kantor'   => 'heroicon-o-building-office-2',
                        'lapangan' => 'heroicon-o-truck',
                        default    => 'heroicon-o-user',
                    }),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Hak Akses')
                    ->options([
                        'admin'    => 'Admin / HRD',
                        'karyawan' => 'Karyawan',
                    ]),

                Tables\Filters\SelectFilter::make('tipe_karyawan')
                    ->label('Tipe Karyawan')
                    ->options([
                        'kantor'   => 'Karyawan Kantor',
                        'lapangan' => 'Sales / Lapangan',
                    ]),

                Tables\Filters\SelectFilter::make('department')
                    ->label('Departemen')
                    ->options(function () {
                        return \App\Models\User::distinct()
                            ->whereNotNull('department')
                            ->pluck('department', 'department')
                            ->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('reset_password')
                    ->label('Reset Password')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->modalHeading('Reset Password Pegawai')
                    ->modalDescription('Password akan direset. Pegawai harus login ulang dengan password baru.')
                    ->modalSubmitActionLabel('Reset Sekarang')
                    ->modalIcon('heroicon-o-key')
                    ->form([
                        Forms\Components\Radio::make('mode')
                            ->label('Pilihan Reset')
                            ->options([
                                'default' => 'Reset ke default: "password"',
                                'custom'  => 'Reset ke password baru (custom)',
                            ])
                            ->default('default')
                            ->required()
                            ->live(),

                        Forms\Components\TextInput::make('custom_password')
                            ->label('Password Baru')
                            ->password()
                            ->minLength(6)
                            ->maxLength(255)
                            ->required(fn (Forms\Get $get) => $get('mode') === 'custom')
                            ->visible(fn (Forms\Get $get) => $get('mode') === 'custom')
                            ->helperText('Minimal 6 karakter. Beritahu pegawai password ini.'),
                    ])
                    ->action(function (User $record, array $data) {
                        $newPassword = $data['mode'] === 'default'
                            ? 'password'
                            : $data['custom_password'];

                        $record->update([
                            'password' => Hash::make($newPassword),
                        ]);

                        Notification::make()
                            ->title('Password Berhasil Direset')
                            ->body("Password untuk **{$record->name}** sudah direset menjadi: **{$newPassword}**\n\nSilakan beritahu pegawai untuk login ulang.")
                            ->success()
                            ->persistent()
                            ->duration(null)
                            ->send();
                    }),

                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square'),

                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('reset_all_password')
                        ->label('Reset Password Terpilih')
                        ->icon('heroicon-o-key')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalHeading('Reset Password Massal')
                        ->modalDescription('Semua pegawai terpilih akan direset passwordnya ke "password".')
                        ->modalSubmitActionLabel('Reset Semua')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            foreach ($records as $user) {
                                $user->update([
                                    'password' => Hash::make('password'),
                                ]);
                            }

                            Notification::make()
                                ->title('Berhasil')
                                ->body("Password {$records->count()} pegawai sudah direset ke default.")
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ])
            ->emptyStateHeading('Belum ada data akun')
            ->emptyStateDescription('Silakan tambah akun pegawai baru.')
            ->emptyStateIcon('heroicon-o-users');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}