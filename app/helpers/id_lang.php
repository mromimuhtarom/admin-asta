<?php


//===========================TRANSLATE SIDEMENU===========================//
function translate_menu($menu){
  
    $array_menu = [
      'Dashboard'                       =>  'Dasbor', 
      'Admin'                           =>  'Admin',
      'User_Admin'                      =>  'Pengguna Admin',
      'Role_Admin'                      =>  'Peran Admin',
      'Log_Admin'                       =>  'Catatan Admin',
      'Active_Admin'                    =>  'Admin aktif',
      'Report_Admin'                    =>  'Laporan Admin',
      'Transaction'                     =>  'Transaksi',
      'Banking_Transactions'            =>  'Transaksi Bank',
      'User_Bank_Transaction'           =>  'Transaksi Bank Pengguna',
      'Reward_Transaction'              =>  'Transaksi hadiah',
      'Players'                         =>  'Pemain',
      'Active_Players'                  =>  'Pemain Aktif',
      'Report_Players'                  =>  'Laporan Pemain',
      'High_Roller'                     =>  'Roll Tinggi',
      'Registered_Players'              =>  'Pemain terdaftar',
      'Guest'                           =>  'Tamu',
      'Bots'                            =>  'Bot',
      'Play_Report'                     =>  'Laporan permainan',
      'Chip_Players'                    =>  'Chip pemain',
      'Gold_Players'                    =>  'Emas pemain',
      'Point_Players'                   =>  'Poin pemain',
      'Register_Player_ID'              =>  'ID pemain terdaftar',
      'Log_Players'                     =>  'Catatan pemain',
      'Slide_Banner'                    =>  'Slide spanduk',
      'Item'                            =>  'Barang',
      'Table_Gift'                      =>  'Meja Gift',
      'Report_Gift'                     =>  'Laporan Gift',
      'Emoticon'                        =>  'Emoticon',
      'Game'                            =>  'Gim',
      'Asta-Poker'                      =>  'Asta Poker',
      'Table_Asta_Poker'                =>  'Meja Asta Poker',
      'Category_Asta_Poker'             =>  'Ketegori Asta Poker',
      'Season_Asta_Poker'               =>  'Musim Asta Poker',
      'Season_Reward_Asta_Poker'        =>  'Hadiah Musim Asta Poker',
      'Tournament_Asta_Poker'           =>  'Turnamen Asta Poker',
      'Jackpot_Paytable_Asta_Poker'     =>  'Jackpot Paytable Asta Poker',
      'Big-Two'                         =>  'Big Two',
      'Table_Big_Two'                   =>  'Meja Big Two',
      'Category_Big_Two'                =>  'Kategori Big Two',
      'Season_Big_Two'                  =>  'Musim Big Two',
      'Season_Reward_Big_Two'           =>  'Hadiah Musim Big Two',
      'Tournament_Big_Two'              =>  'Turnamen Big Two',
      'Jackpot_Paytable_Big_Two'        =>  'Jackpot Paytable Big Two',
      'Domino-Susun'                    =>  'Domino susun',
      'Table_Domino_Susun'              =>  'Meja domino susun',
      'Category_Domino_Susun'           =>  'Kategori domino susun',
      'Season_Domino_Susun'             =>  'Musim Domino susun',
      'Season_Reward_Domino_Susun'      =>  'Hadiah musim Domino susun',
      'Tournament_Domino_Susun'         =>  'Turnamen Domino susun',
      'Jackpot_Paytable_Domino_Susun'   =>  'Jakcpot Paytable Domino Susun',
      'Domino-QQ'                       =>  'Domino QQ',
      'Table_Domino_QQ'                 =>  'Meja Domino QQ',
      'Category_Domino_QQ'              =>  'Kategori Domino QQ',
      'Season_Domino_QQ'                =>  'Musim Domino QQ',
      'Season_Reward_Domino_QQ'         =>  'Hadiah Musim Domino QQ',
      'Tournament_Domino_QQ'            =>  'Turnamen Domino QQ',
      'Jackpot_Paytable_Domino_QQ'      =>  'Jackpot Paytable Domino QQ',
      'Game_Setting'                    =>  'Pengaturan permainan',
      'Store'                           =>  'Toko',
      'Best_Offer'                      =>  'Penawaran terbaik',
      'Chip_Store'                      =>  'Toko Chip',
      'Gold_Store'                      =>  'Toko Koin',
      'Goods_Store'                     =>  'Toko Barang',
      'Payment_Store'                   =>  'Toko Pembayaran',
      'Report_Store'                    =>  'Laporan Toko',
      'Notification'                    =>  'Pemberitahuan',
      'Push_Notification'               =>  'Pemberitahuan push',
      'Email_Notification'              =>  'Pemberitahuan Email',
      'FeedBack'                        =>  'Umpan balik',
      'Report_Abuse_Player'             =>  'Laporan penyalahgunaan pemain',
      'Abuse_Transaction_Report'        =>  'Laporan penyalahgunaan transaksi',
      'Feedback_Game'                   =>  'Umpan Balik permainan',
      'Settings'                        =>  'Pengaturan',
      'General_Setting'                 =>  'Pengaturan umum',
      'Reseller'                        =>  'Agen',
      'List_Reseller'                   =>  'Daftar Agen',
      'Reseller-Transaction'            =>  'Transaksi Agen',
      'Request_Transaction'             =>  'Transaksi Permintaan',
      'Report_Transaction'              =>  'Laporan Transaksi',
      'Balance_Reseller'                =>  'Balance Agen',
      'Item_Store_Reseller'             =>  'Toko Agen',
      'Reseller_Rank'                   =>  'Peringkat Agen',
      'Register_Reseller'               =>  'Pendaftaran Agen',
      'Version_Asset_Apk'               =>  'Versi Aset Apk',
      'logout'                          =>  'Keluar'
    ];

    return $array_menu[$menu];
}


//=================================MENU ADMIN===============================//
function translate_MenuContentAdmin($menu){
    
    $array_menuContent = [

        'Admin'                         =>  'Admin',
        'User Admin'                    =>  'Pengguna Admin',
        'Role Admin'                    =>  'Peran Admin',
        'Log Admin'                     =>  'Catatan Admin',
        'Active Admin'                  =>  'Admin Aktif',
        'Report Admin'                  =>  'Laporan Admin',
        'Create User Admin'             =>  'Buat admin baru',
        'Create Role Admin'             =>  'Buat peran admin',
        'Choose Action'                 =>  'Pilih Aksi',
        
        //PILIH AKSI
        'Create Admin'                  =>  'Buat Admin',
        'Delete Admin'                  =>  'Hapus Admin',
        'Edit Admin'                    =>  'Edit Admin',
        'Decline Admin'                 =>  'Tolak Admin',
        'Approve Admin'                 =>  'Setujui Admin',
        'Change Password Admin'         =>  'Ubah Katasandi Admin',


        'Choose Role'                   =>  'Pilih Peran',
        'Choose Log Type'               =>  'Pilih tipe Log',
        'Players Online'                =>  'Pemain Online',
        'Save'                          =>  'Simpan',
        'Search'                        =>  'Cari',
        'Cancel'                        =>  'Batal',
        'Change title to update and save instantly!' => 'Ubah judul untuk memperbarui dan menyimpan secara instan!',
        'Create New User'               =>  'Buat Pengguna Baru',
        'Create New Role'               =>  'Buat Peran Baru',
        'Select All'                    =>  'Pilih semua',
        'Admin ID'                      =>  'ID Admin',
        'Admin Report'                  =>  'Laporan Admin',
        'Player ID'                     =>  'ID Pemain',
        'Username'                      =>  'Nama pengguna',
        'Status'                        =>  'Status',
        'Role Name'                     =>  'Nama peran',
        'Full Name'                     =>  'Nama lengkap',
        'Role Type'                     =>  'Tipe peran',
        'Date'                          =>  'Tanggal',
        'Date Login'                    =>  'Tanggal Login',
        'Time Stamp'                    =>  'Waktu',
        'Ip'                            =>  'Alamat IP',
        'Description'                   =>  'Deskripsi',
        'Action'                        =>  'Aksi',
        'Reset Password'                =>  'Atur ulang kata sandi',
        'Delete Data'                   =>  'Hapus data',
        'View & Edit'                   =>  'Tampil dan Ubah',
        'Are You Sure Want To Delete It?'            =>  'Anda yakin ingin menghapusnya?',
        'Yes'                           =>  'Ya',
        'No'                            =>  'No',
        'Delete all selected Data'      =>  'Hapus semua data yang dipilih',
        'Are You Sure Want To Delete all selected?'  =>  'Anda yakin ingin menghapus semua yang telah dipilih?'
    ];

    return $array_menuContent[$menu];
}


//=========================MENU TRANSACTION========================//
function translate_menuTransaction($menu){

    $array_menuContent = [

        'Transaction'           =>  'Transaksi',
        'Reward Transaction'    =>  'Reward Transaction',
        'Banking Transaction'   =>  'Transaksi Banking',
        
        //PILIH AKSI
        'Choose Time'           =>  'Pilih waktu',
        'Today'                 =>  'Hari ini',
        'Week'                  =>  'Pekan',
        'Month'                 =>  'Bulan',
        'All time'              =>  'Sepanjang Waktu',

        'Bank Transaction'      =>  'Transaksi Bank',
        'ID Player'             =>  'ID pemain',
        'Item'                  =>  'Barang',
        'Username'              =>  'Nama pengguna',
        'Date'                  =>  'Tanggal',
        'Win'                   =>  'Menang',
        'Lose'                  =>  'Kalah',
        'Turn Over'             =>  'Turn Over',
        'Fee'                   =>  'Biaya'
    ];
    return $array_menuContent[$menu];
}

?>