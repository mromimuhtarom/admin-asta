<?php

function xmlfile()
{
    // $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
    $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
    
    return $xml;
}

//===========================TRANSLATE SIDEMENU===========================//
function translate_menu($menu){
  
    $array_menu = [
      'Dashboard'                       =>  xmlfile()->L_PASSWORD->attributes()->val, 
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
      'Add_Transaction'                 =>  'Add Transaction',
      'Players'                         =>  'Pemain',
      'Active_Players'                  =>  'Pemain Aktif',
      'Report_Players'                  =>  'Laporan Pemain',
      'High_Roller'                     =>  'High Roller',
      'Registered_Players'              =>  'Pemain terdaftar',
      'Guest'                           =>  'Tamu',
      'Bots'                            =>  'Bot',
      'Play_Report'                     =>  'Laporan permainan',
      'Chip_Players'                    =>  'Chip pemain',
      'Gold_Players'                    =>  'Koin pemain',
      'Point_Players'                   =>  'Poin pemain',
      'Register_Player_ID'              =>  'ID pemain terdaftar',
      'Log_Players'                     =>  'Catatan pemain',
      'Transaction_Players'             =>  'Transaksi Pemain',
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
        'User Bank Transaction' =>  'Transaksi Bank Pengguna',
        
        
        //PILIH AKSI
        'Choose Time'           =>  'Pilih waktu',
        'Today'                 =>  'Hari ini',
        'Week'                  =>  'Mingguan',
        'Month'                 =>  'Bulanan',
        'All time'              =>  'Sepanjang Waktu',

        'Time Stamp'            =>  'Waktu',
        'Bank Transaction'      =>  'Transaksi Bank',
        'Bank Manual Transfer'  =>  'Transfer Bank Manual',
        'ID Player'             =>  'ID pemain',
        'Item'                  =>  'Barang',
        'Quantity'              =>  'Kuantitas',
        'Price'                 =>  'Harga',
        'Detail Information'    =>  'Informasi detail',
        'buy'                   =>  'membeli',
        'using'                 =>  'memakai',
        'at price'              =>  'di harga',
        'Awarded'               =>  'Awarded',
        'Type'                  =>  'Tipe',
        'Status'                =>  'Status',
        'Decline'               =>  'Tolak',
        'Decline Transaction'   =>  'Tolak transaksi',
        'Approve Transaction'   =>  'Terima transaksi',
        'Are you sure want to Decline this Transaction?'    =>  'Anda yakin akan menolak transaksi ini?',
        'Are you sure want to Approve this Transaction?'    =>  'Anda yakin akan menerima transaksi ini?',
        'Approve'               =>  'Terima',
        'Pending'               =>  'Tunda',
        'Status Payment'        =>  'Status pembayaran',
        'Confirm request'       =>  'Konfirmasi permintaan',
        'Username'              =>  'Nama pengguna',
        'Date'                  =>  'Tanggal',
        'Win'                   =>  'Menang',
        'Lose'                  =>  'Kalah',
        'Turn Over'             =>  'Turn Over',
        'Fee'                   =>  'Biaya',
        'Yes'                   =>  'Ya',
        'No'                    =>  'No',
        'pending'               =>  'Tunda'
    ];
    return $array_menuContent[$menu];
}

function Translate_menuPlayers($menu){

    $array_menuContent = [

        'Players'                   =>  'Pemain',
        'Active Players'            =>  'Pemain aktif',
        'Report Player'             =>  'Laporan Pemain',
        'Play report'               =>  'Laporan permainan',
        'Players Online'            =>  'Pemain online',
        'Registered Player'         =>  'Pemain terdaftar',
        'Guest'                     =>  'Tamu',
        'Choose Register Type'      =>  'Pilih tipe daftar',
        'Choose Game'               =>  'Pilih gim',
        'Choose Log Type'           =>  'Pilih tipe Catatan',
        'Choose status'             =>  'Pilih status',
        'Total Record Entries is'   =>  'Total entri catatan adalah',
        'Create user guest ID'      =>  'Buat ID user tamu',
        'Bank Account'              =>  'Akun Bank',
        'Country'                   =>  'Negara',
        'Player ID'                 =>  'ID pemain',
        'Guest ID'                  =>  'ID tamu',
        'Device ID'                 =>  'ID perangkat',
        'Round ID'                  =>  'ID putaran',
        'Detail round ID'           =>  'Detail ID putaran',
        'Playername'                =>  'Nama pemain',
        'Username'                  =>  'Nama pengguna',
        'Playing Game'              =>  'Bermain di',
        'Rank'                      =>  'Peringkat',
        'Table'                     =>  'Meja',
        'Hand card'                 =>  'Hand card',
        'Seat'                      =>  'Tempat duduk',
        'Sit'                       =>  'duduk',
        'Bet'                       =>  'Taruhan',
        'Win Lose'                  =>  'Menang Kalah',
        'Chip'                      =>  'Chip',
        'Point'                     =>  'Poin',
        'Action'                    =>  'Aksi',
        'Gold Coins'                =>  'Koin',
        'Card'                      =>  'Kartu',
        'Domino'                    =>  'Domino',
        'Card Table'                =>  'Meja kartu',
        'Device Timer'              =>  'Device Timer',
        'Used'                      =>  'Terpakai',
        'Non used'                  =>  'Tidak terpakai',
        'From'                      =>  'Dari',
        'Playing Games'             =>  'Kategori gim',
        'Table Name'                =>  'Nama meja',
        'Timestamp'                 =>  'Waktu',
        'Status'                    =>  'Status',
        'Date Created'              =>  'Waktu dibuat',
        'Register Form'             =>  'Form pendaftaran',
        'IP'                        =>  'Alamat IP',
        'Player'                    =>  'Pemain',
        'Guest'                     =>  'Tamu',
        'Approve'                   =>  'Setuju',
        'Banned'                    =>  'Dilarang',
        'Problem'                   =>  'Bermasalah',
        'Save'                      =>  'Simpan',
        'Cancel'                    =>  'Batal'

    ];
    return $array_menuContent[$menu];
}




?>