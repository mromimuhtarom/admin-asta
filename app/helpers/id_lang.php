<?php

// function xmlfile()
// {
//     // $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
//     $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
    
//     return $xml;
// }

//===========================TRANSLATE SIDEMENU===========================//
function translate_menu($menu){

    // dd(xmlfile()->L_Email_Notification->attributes()->val);
  
    $array_menu = [
      'Dashboard'                       =>  'Dasbor', 
      'Admin'                           =>  'Admin',
      'User_Admin'                      =>  'Pengguna Admin',
      'Role_Admin'                      =>  'Peran Admin',
      'Log_Admin'                       =>  'Catatan Admin',
      'Active_Admin'                    =>  'Admin aktif',
      'Report_Admin'                    =>  'Laporan admin',
      'Transaction'                     =>  'Transaksi',
      'Banking_Transactions'            =>  'Transaksi Banking',
      'User_Bank_Transaction'           =>  'Transaksi Bank Pemain',
      'Reward_Transaction'              =>  'Transaksi Hadiah',
      'Add_Transaction'                 =>  'Tambah transaksi',
      'Players'                         =>  'Pemain',
      'Active_Players'                  =>  'Pemain aktif',
      'Report_Players'                  =>  'Laporan pemain',
      'High_Roller'                     =>  'High roller',
      'Registered_Players'              =>  'Pemain terdaftar',
      'Guest'                           =>  'Guest',
      'Bots'                            =>  'Bot',
      'Play_Report'                     =>  'Laporan permainan',
      'Chip_Players'                    =>  'Chip pemain',
      'Gold_Players'                    =>  'Koin pemain',
      'Point_Players'                   =>  'Poin pemain',
      'Register_Player_ID'              =>  'ID pemain terdaftar',
      'Log_Players'                     =>  'Catatan Pemain',
      'Transaction_Players'             =>  'Transaksi pemain',
      'Players_Level'                   =>  'Level pemain',
      'avatar_player'                   =>  'avatar pemain',
      'Slide_Banner'                    =>  'Slide spanduk',
      'Item'                            =>  'Item',
      'Table_Gift'                      =>  'Table gift',
      'Report_Gift'                     =>  'Laporan gift',
      'Emoticon'                        =>  'Emoticon',
      'Game'                            =>  'Permainan',
      'Asta-Poker'                      =>  'Asta-Poker',
      'Table_Asta_Poker'                =>  'Table Asta poker',
      'Category_Asta_Poker'             =>  'Kategori',
      'Season_Asta_Poker'               =>  'Musim Asta Poker',
      'Season_Reward_Asta_Poker'        =>  'Hadiah musim Asta Poker',
      'Tournament_Asta_Poker'           =>  'Turnamen Asta Poker',
      'Jackpot_Paytable_Asta_Poker'     =>  'Jackpot Paytable Asta Poker',
      'Big-Two'                         =>  'Big Two',
      'Table_Big_Two'                   =>  'Table Big Two',
      'Category_Big_Two'                =>  'Kategori Big Two',
      'Season_Big_Two'                  =>  'Musim Big Two',
      'Season_Reward_Big_Two'           =>  'Hadiah musim Big Two',
      'Tournament_Big_Two'              =>  'Turnamen Big Two',
      'Jackpot_Paytable_Big_Two'        =>  'Jackpot Paytable Big Two',
      'Domino-Susun'                    =>  'Domino susun',
      'Table_Domino_Susun'              =>  'Table domino susun',
      'Category_Domino_Susun'           =>  'Kategori domino susun',
      'Season_Domino_Susun'             =>  'Musim domino susun',
      'Season_Reward_Domino_Susun'      =>  'Hadiah musim Domino susun',
      'Tournament_Domino_Susun'         =>  'Turnamen Domino susun',
      'Jackpot_Paytable_Domino_Susun'   =>  'Jackpot paytable Domino susun',
      'Domino-QQ'                       =>  'Domino-QQ',
      'Table_Domino_QQ'                 =>  'Table Domino-QQ',
      'Category_Domino_QQ'              =>  'Kategori Domino-QQ',
      'Season_Domino_QQ'                =>  'Musim Domino-QQ',
      'Season_Reward_Domino_QQ'         =>  'Hadiah musim Domini-QQ',
      'Tournament_Domino_QQ'            =>  'Turnamen Domino-QQ',
      'Jackpot_Paytable_Domino_QQ'      =>  'Jackpot paytable Domino-QQ',
      'Game_Setting'                    =>  'Pengaturan Game',
      'Store'                           =>  'Toko',
      'Best_Offer'                      =>  'Penawaran terbaik',
      'Chip_Store'                      =>  'Toko Chip',
      'Gold_Store'                      =>  'Toko Koin',
      'Goods_Store'                     =>  'Toko Barang',
      'Payment_Store'                   =>  'Toko Pembayaran',
      'Report_Store'                    =>  'Laporan Toko',
      'Notification'                    =>  'Pemberitahuan',
      'Push_Notification'               =>  'Pemberitahuan push',
      'Email_Notification'              =>  'Pemberitahuan email',
      'FeedBack'                        =>  'Umpan balik',
      'Report_Abuse_Player'             =>  'Laporan penyalahgunaan pemain',
      'Abuse_Transaction_Report'        =>  'Laporan penyalahgunaan transaksi',
      'Feedback_Game'                   =>  'Umpan balik game',
      'Settings'                        =>  'Pengaturan',
      'General_Setting'                 =>  'Pengaturan umum',
      'Reseller'                        =>  'Agen',
      'List_Reseller'                   =>  'Daftar agen',
      'Reseller-Transaction'            =>  'Transaksi Agen',
      'Request_Transaction'             =>  'Transaksi permintaan',
      'Report_Transaction'              =>  'Laporan Transaksi',
      'Balance_Reseller'                =>  'Saldo agen',
      'Item_Store_Reseller'             =>  'Toko item agen',
      'Reseller_Rank'                   =>  'Rank agen',
      'Register_Reseller'               =>  'Pendaftaran agen',
      'Version_Asset_Apk'               =>  'Versi asset apk',
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
        'Active Admin'                  =>  'Admin aktif',
        'Report Admin'                  =>  'Laporan Admin',
        'Create User Admin'             =>  'Buat Admin',
        'Create Role Admin'             =>  'Buat peran admin',
        'Choose Action'                 =>  'Pilih Aksi',
        
        //PILIH AKSI
        'Create Admin'                  =>  'Buat admin',
        'Delete Admin'                  =>  'Hapus admin',
        'Edit Admin'                    =>  'Edit admin',
        'Decline Admin'                 =>  'Tolak admin',
        'Approve Admin'                 =>  'Terima admin',
        'Change Password Admin'         =>  'Ganti katasandi admin',


        'Choose Role'                   =>  'Pilih peran',
        'Choose Log Type'               =>  'Pilih Tipe Log',
        'Players Online'                =>  'Pemain online',
        'Save'                          =>  'Simpan',
        'Search'                        =>  'Cari',
        'Cancel'                        =>  'Batal',
        'Change title to update and save instantly!' => 'Ganti judul untuk memperbarui dan menyimpan secara instan!',
        'Create New User'               =>  'Buat pengguna baru',
        'Create New Role'               =>  'Buat peran baru',
        'Select All'                    =>  'Pilih semua',
        'Admin ID'                      =>  'ID Admin',
        'Admin Report'                  =>  'Laporan admin',
        'Player ID'                     =>  'ID pemain',
        'Username'                      =>  'Nama pengguna',
        'Status'                        =>  'Status',
        'Role Name'                     =>  'Nama peran',
        'Full Name'                     =>  'Nama lengkap',
        'Role Type'                     =>  'Tipe peran',
        'Date'                          =>  'Tanggal',
        'Date Login'                    =>  'Tanggal login',
        'Time Stamp'                    =>  'Waktu',
        'Ip'                            =>  'IP',
        'Description'                   =>  'Deskripsi',
        'Action'                        =>  'Aksi',
        'Reset Password'                =>  'Reset Katasandi',
        'Delete Data'                   =>  'Hapus data',
        'View & Edit'                   =>  'Lihat dan Edit',
        'Are You Sure Want To Delete It?'            => 'Apakah anda yakin akan mengahusnya?',
        'Yes'                           =>  'Ya',
        'No'                            =>  'Tidak',
        'Delete all selected Data'      =>  'Hapus semua data terpilih?',
        'Are You Sure Want To Delete all selected?'  =>  'Apakah anda yakin akan menghapus semua data yang dipilih?',
    ];

    return $array_menuContent[$menu];
}


// //=========================MENU TRANSACTION========================//
function translate_menuTransaction($menu){

    $array_menuContent = [

        'Transaction'           =>  'Transaksi',
        'Reward Transaction'    =>  'Reward transaksi',
        'Banking Transaction'   =>  'Transaksi Banking',
        'User Bank Transaction' =>  'Transaksi User bank',
        
        
        //PILIH AKSI
        'Choose Time'           =>  'Pilih waktu',
        'Today'                 =>  'Hari ini',
        'Week'                  =>  'Mingguan',
        'Month'                 =>  'Bulanan',
        'All time'              =>  'Sepanjang waktu',

        'Time Stamp'            =>  'Waktu',
        'Bank Transaction'      =>  'Transaksi Bank',
        'Bank Manual Transfer'  =>  'Transaksi bank manual',
        'ID Player'             =>  'ID pemain',
        'Item'                  =>  'Item',
        'Quantity'              =>  'Jumlah',
        'Price'                 =>  'Harga',
        'buy'                   =>  'membeli',
        'using'                 =>  'menggunakan',
        'at price'              =>  'pada harga',
        'Awarded'               =>  'hadiah',
        'Type'                  =>  'tipe',
        'Item Status'           =>  'Status Barang',
        'Decline'               =>  'Tolak',
        'Decline Transaction'   =>  'Tolak transaksi',
        'Approve Transaction'   =>  'Terima transaksi',
        'Are you sure want to Decline this Transaction?'    =>  'Anda yakin akan menolak transaksi ini ?',
        'Are you sure want to Approve this Transaction?'    =>  'Anda yakin akan menerima transaksi ini ?',
        'Approve'               =>  'Terima',
        'Pending'               =>  'Tunda',
        'Status Payment'        =>  'Status pembayaran',
        'Confirm request'       =>  'Konfirmasi permintaan',
        'Username'              =>  'Nama pengguna',
        'Status'                =>  'Status',
        'Date'                  =>  'Tanggal',
        'Win'                   =>  'Menang',
        'Lose'                  =>  'Kalah',
        'Turn Over'             =>  'Turn Over',
        'Fee'                   =>  'Biaya',
        'Yes'                   =>  'Ya',
        'No'                    =>  'Tidak',
        'pending'               =>  'Tunda',
        'Delivery Confirmation' =>  'Informasi Pengiriman',
        'Delivery Status'       =>  'Status Pengiriman',
        'Detail Info'           =>  'Detail Info',
        'Full Name'             =>  'Nama Lengkap',
        'Email'                 =>  'Email',
        'Phone'                 =>  'No. Telp',
        'Province'              =>  'Provinsi',
        'Address'               =>  'Alamat',
        'City'                  =>  'Kota',
        'Postal Code'           =>  'Kode Pos',
        'On Process'            =>  'Di Proses',
        'Request'               =>  'Permintaan',
        'Pending'               =>  'Tertunda',
        'Required Delivery Status'  =>  'Wajib diisi status pengiriman',
        'If The Item Has Been Sent' =>  'Jika barang telah dikirim',
        'Date Sent'             =>  'Tanggal Dikirim',
        'Item Name'             =>  'Nama Barang',
        'Type Of Shipment'      =>  'Jenis Pengiriman (Transfer, JNE, TIKI, DLL)',
        'Shipping Code'         =>  'Kode Pengiriman (No Resi / No Transferan)',
        'Completed'             =>  'Selesai',
        'Confirmation'          =>  'Konfirmasi',
        'Jackpot'               =>  'Jackpot',
        'Win Lose'              =>  'Menang Kalah'
    ];
    return $array_menuContent[$menu];
}

function Translate_menuPlayers($menu){

    $array_menuContent = [

        'Players'                   =>  'Pemain',
        'Active Players'            =>  'Pemain aktif',
        'Report Player'             =>  'Laporan pemain',
        'Play report'               =>  'Laporan permainan',
        'Players Online'            =>  'Pemain online',
        'Registered Player'         =>  'Pemain terdaftar',
        'RegisteredPlayerID'        =>  'ID pemain terdaftar',
        'LogPlayers'                =>  'Catatan Pemain',
        'NumberOfIDsToBeAdded'      =>  'Jumlah ID yang akan ditambah',
        'Chip Players'              =>  'Chip pemain',
        'Gold Players'              =>  'Koin pemain',
        'Point Players'             =>  'Poin pemain',
        'Guest'                     =>  'Guest',
        'Choose Register Type'      =>  'Pilih tipe pendaftaran',
        'Choose Game'               =>  'Pilih game',
        'Choose Log Type'           =>  'Pilih tipe Log',
        'Choose status'             =>  'Pilih status',
        'Choose User Type'          =>  'Pilih tipe pengguna',
        'Choose Action'             =>  'Pilih aksi',
        'Total Record Entries is'   =>  'Total entri catatan adalah',
        'Create user guest ID'      =>  'Buat ID pengguna guest',
        'Bank Account'              =>  'Akun Bank',
        'Country'                   =>  'Negara',
        'Create Player'             =>  'Buat pemain',
        'Delete Player'             =>  'Hapus pemain',
        'Edit Player'               =>  'Edit pemain',
        'Change Password Player'    =>  'Ganti katasandi pemain',
        'Total Record Entries is'   =>  'Total entri catatan adalah',
        'Player ID'                 =>  'ID pemain',
        'Guest ID'                  =>  'ID Guest',
        'Device ID'                 =>  'ID perangkat',
        'Round ID'                  =>  'ID round',
        'Detail round ID'           =>  'Detail ID round',
        'ID Player already'         =>  'ID pemain yang sudah ada',
        'Player ID used'            =>  'ID pemain terpakai',
        'Guest ID used'             =>  'ID guest terpakai',
        'Bot ID used'               =>  'ID bot terpakai',
        'Player ID didnt use'       =>  'ID pemain tidak terpakai',
        'Guest ID didnt use'        =>  'ID guest tidak terpakai',
        'Bot ID didnt use'          =>  'ID bot tidak terpakai',
        'Total Player ID'           =>  'Total ID pemain',
        'Total Guest ID'            =>  'Total ID guest',
        'Total Bot ID'              =>  'Total ID bot',
        'Playername'                =>  'Nama pemain',
        'Game'                      =>  'Game',
        'UserType'                  =>  'Tipe pengguna',
        'Username'                  =>  'Nama pengguna',
        'Desc'                      =>  'Deskripsi',
        'Playing Game'              =>  'Bermain di',
        'Rank'                      =>  'Peringkat',
        'Level'                     =>  'Level',
        'Table'                     =>  'Table',
        'Hand card'                 =>  'Hand card',
        'Seat'                      =>  'Tempat duduk',
        'Sit'                       =>  'duduk',
        'Bet'                       =>  'Taruhan',
        'Win Lose'                  =>  'Menang Kalah',
        'Chip'                      =>  'Chip',
        'Goods'                     =>  'Barang',
        'Point'                     =>  'Poin',
        'Action'                    =>  'Aksi',
        'Gold Coins'                =>  'Koin',
        'Card'                      =>  'kartu',
        'Domino'                    =>  'Domino',
        'Card Table'                =>  'Kartu table',
        'Device Timer'              =>  'Tanggal',
        'Used'                      =>  'Terpakai',
        'Non used'                  =>  'Tidak terpakai',
        'From'                      =>  'dari',
        'Debit'                     =>  'Debit',
        'Credit'                    =>  'Kredit',
        'Total'                     =>  'Total',
        'Playing Games'             =>  'Kategori game',
        'Table Name'                =>  'Nama table',
        'Timestamp'                 =>  'Waktu dibuat',
        'Status'                    =>  'Status',
        'Date Created'              =>  'Waktu dibuat',
        'Register Form'             =>  'Form pendaftaran',
        'IP'                        =>  'Alamat IP',
        'Player'                    =>  'Pemain',
        'Guest'                     =>  'Guest',
        'Approve'                   =>  'Setuju',
        'Banned'                    =>  'Dilarang',
        'Problem'                   =>  'Bermasalah',
        'Save'                      =>  'Simpan',
        'Cancel'                    =>  'Cancel',
        'Players level'             =>  'Level pemain',
        'Create player level'       =>  'Buat level pemain',
        'Level'                     =>  'Maks Level',
        'Experience'                =>  'Maks Pengalaman',
        'Player Rank'               =>  'Peringkat player',
        'Create Rank Player'        =>  'Buat peringkat pemain',
        'Save Avatar'               =>  'Simpan avatar',
        'Edit Avatar'               =>  'Ubah avatar',
        'Edit'                      =>  'Edit',
        'Main'                      =>  'Utama',
        'Confirmation'              =>  'Konfirmasi'

    ];
    return $array_menuContent[$menu];
}


function TranslateMenuItem($menu){

    $array_menuContent = [

        'Item'              =>  'Item',
        'Table Gift'        =>  'Table gift',
        'Create New Gift'   =>  'Buat gift baru',
        'Report Gift'       =>  'Laporan gift',
        'Select All'        =>  'Pilih semua',
        'Image'             =>  'Gambar',
        'Title'             =>  'Judul',
        'Price'             =>  'Harga',
        'Category'          =>  'Kategori',
        'Status'            =>  'Status',
        'Main Image'        =>  'Gambar utama',
        'Save Gift'         =>  'Simpan gift',
        'Save'              =>  'Simpan',
        'Cancel'            =>  'Batal',
        'Edit Gift'         =>  'Edit gift',
        'Create gift store' =>  'Buat toko gift',
        'DeleteData'        =>  'Hapus data',
        'Are you sure want to delete it' => 'Apakah anda yakin akan menghapusnya?',
        'Yes'               =>  'Ya',
        'No'                =>  'Tidak',
        'Delete all selected data'       => 'Hapus semua data terpilih',
        'Are U Sure'        =>  'Apakah anda yakin akan menghapus semua data yang dipilih?',
        'Choose Game'       =>  'Pilih game',
        'Username'          =>  'Nama pengguna',
        'Action Game'       =>  'Aksi game',
        'Date'              =>  'date',
        'Description'       =>  'Deskripsi',
        'Emoticon'          =>  'Emoticon',
        'Create New Emoticon'=> 'Buat emotikon baru',
        'Create Emoticon'   =>  'Buat emotikon',
        'Edit'              =>  'Ubah'
    ];

    return $array_menuContent[$menu];

}


function TranslateMenuGame($menu){

    $array_menuContent = [
        'Table'                => 'Table',
        'Table Player'         => 'Table pemain',
        'Change Title'         => 'Ganti  nama',
        'Create New Table'     => 'Buat table baru',
        'Table Name'           => 'Nama table',
        'Group'                => 'Grup',
        'Max Player'           => 'Pemain maks',
        'Small Blind'          => 'Small blind',
        'Big Blind'            => 'Big blind',
        'Jackpot'              => 'Jackpot',
        'Min Buy'              => 'Minimal beli',
        'Max Buy'              => 'Maksimal beli',
        'Timer'                => 'Timer',
        'Action'               => 'Aksi',
        'Create Table'         => 'Buat table',
        'Select Category'      => 'Pilih kategori',
        'Save'                 => 'Simpan',
        'Cancel'               => 'Batal',
        'Delete Data'          => 'Hapus data',
        'Are you sure'         => 'Apakah anda yakin ingin menghapusnya?',
        'Yes'                  => 'Ya',
        'No'                   => 'Tidak',
        'Category'             => 'Kategori',
        'Asta Poker Table'     => 'Asta poker table',
        'Title'                => 'Judul',
        'Create Category'      => 'Buat kategori',
        'Asta Big Two Table'   => 'Asta Big Two table',
        'Create New Table'     => 'Buat table baru',
        'Turn'                 => 'Giliran',
        'Total Bet'            => 'Total Taruhan',
        'Stake'                => 'Stake',
        'Timer'                => 'Timer',
        'Game state'           => 'Status permainan',
        'Current turn seat ID' => 'Giliran ID kursi saat ini',
        'Room Name'            => 'Nama room',
        'Name'                 => 'Nama',
        'Upload File'          => 'Unduh File',
        'Language'             => 'Bahasa',
        'Indonesia'            => 'Indonesia',
        'English'              => 'Inggris',
        'Upload File Language' => 'Unduh File Bahasa'

    ];

    return $array_menuContent[$menu];
}


function TranslateMenuToko($menu){

    $array_menuContent = [

        'Best Offer'        =>  'Penawaran terbaik',
        'Store'             =>  'Toko',
        'Image'             =>  'Gambar',
        'Title'             =>  'Judul',
        'Rate'              =>  'Rate',
        'Category'          =>  'Kategori',
        'Price cash'        =>  'Harga cash',
        'As long'           =>  'As long',
        'Pay Transaction'   =>  'Transaksi pembayaran',
        'Action'            =>  'Aksi',
        'Create best offer' =>  'Buat penawaran terbaik',
        'Day'               =>  'Hari',
        'Payment method'    =>  'Metode pembayaran',
        'Transaction type'  =>  'Tipe transaksi',
        'Bank Transfer'     =>  'Transfer Bank',
        'Internet Banking'  =>  'Imternet banking',
        'Cash Digital'      =>  'Uang digital',
        'Manual transfer'   =>  'Transfer manual',
        'Shop'              =>  'Toko',
        'Credit card'       =>  'Kartu kredit',
        'Store'             =>  'Toko',
        'Chip store'        =>  'Toko chip',
        'Goods Store'       =>  'Toko barang',
        'Report store'      =>  'Laporan toko',
        'Payment Store'     =>  'Toko pembayaran',
        'Create new chip store'=> 'Buat Toko chip baru',
        'Create new goods store'=> 'Buat Toko barang baru',
        'Create new payment store'=> 'Buat Toko pembayaran baru',
        'Order'             =>  'No urut',
        'Chip Awarded'      =>  'Chip yang didapat',
        'Gold Awarded'      =>  'Koin yang didapat',
        'Gold Cost'         =>  'Harga koin',
        'Active'            =>  'Aktif',
        'Main Image'        =>  'Gambar utama',
        'Save Image'        =>  'Simpan gambar',
        'Edit'              =>  'Edit',
        'Create new gold store' =>  'Buat toko koin baru',
        'Item type'         =>  'Tipe item',
        'Pay Transaction'   =>  'Transaksi pembayaran',
        'Price Point'       =>  'Price poin',
        'Choose type date'  =>  'Pilih tipe tanggal',
        'Date approve and Decline' => 'Tanggal disetujui dan ditolak',
        'Date Request'      =>  'Tanggal Pembelian',
        'Item awarded'      =>  'Item diberikan',
        'Bonus Item'        =>  'Bonus Item',
        'Status Information' => 'Informasi Status',
        'Player ID'         =>  'ID Pemain',
        'Username'          =>  'Nama Pengguna',
        'Item'              =>  'Item',
        'Quantity'          =>  'Jumlah',
        'Description'       =>  'Deskripsi',
        'Price'             =>  'Harga',
        'Confirmation'      =>  'Konfirmasi',
        'Status'            =>  'Status',
        'Date Sent'         =>  'Tanggal Pengiriman',
        'The Date The Item Was Received'    =>  'Tanggal Diterima',
        'Type Of Delivery'  =>  'Jenis Pengiriman',
        'Code Receipt'      =>  'Kode pengiriman (no resi / no transferan)',
        'Success'           =>  'Sukses',
        'Decline'           =>  'Ditolak',
        'Received And Sent' =>  'Terima & Dikirm',
        'Payment Type'      =>  'Tipe Pembayaran'

    ];

    return $array_menuContent[$menu];
}


function TranslateMenuFeedback($menu){

    $array_menuContent = [

        'Feedback'                  =>  'Umpan balik',
        'Abuse Transaction Report'  =>  'Laporan penyalahgunaan Transaksi',
        'Report Abuse Player'       =>  'Laporan penyalahgunaan pemain',
        'Image Proof'               =>  'Image proof',
        'Rating'                    =>  'Penilaian',
        'Message'                   =>  'Pesan',
        'User ID sender'            =>  'ID pengirim',
        'Username sender'           =>  'Nama pengirim',
        'Reported User ID'          =>  'ID pengguna yang dilaporkan',
        'Reported User'             =>  'Pengguna yang dilaporkan',
        'Reason'                    =>  'Alasan',


    
    ];
    return $array_menuContent[$menu];
}

function TranslateGeneralSettings($menu){

    $array_menuContent = [

        'System settings'           =>  'Pengaturan setting',
        'Maintenance'               =>  'Pemeliharaan',
        'Point expired'             =>  'Masa aktif pemain',
        'Award Signup'              =>  'Hadiah sign up',
        'Award Signup Guest'        =>  'Hadiah sign up sebagai guest',
        'Award Daily Chips'         =>  'Hadiah chip harian',
        'Award Daily Chips Guest'   =>  'Hadiah chip harian guest',
        'Award Daily Days'          =>  'Hadiah harian',
        'Award Daily Multiply'      =>  'Hadiah berlipat harian',
        'Bank Settings'             =>  'Pengaturan Bank',
        'Info Settings'             =>  'Pengaturan info',
        'About'                     =>  'Tentang',
        'Edit About'                =>  'Edit Tentang',
        'CS & Legal Settings'       =>  'CS dan pengaturan legal',
        'Edit privacy & policy'     =>  'Edit Kebijakan dan privasi',
        'Edit Term of Service'      =>  'Edit Ketentuan pelayanan',
        'days'                      =>  'Hari',
        'Edit Asta Poker'           =>  'Edit Asta Poker'


    ];
    return $array_menuContent[$menu];
}

function TranslateReseller($menu){

    $array_menuContent = [

        'Reseller ID'           =>  'ID agen',
        'Phone'                 =>  'Telefon',
        'Saldo gold'            =>  'Saldo koin',
        'Report Transaction'    =>  'Laporan transaksi',
        'Bonus Item'            =>  'Bonus item',
        'Balance'               =>  'Saldo',
        'Gold Group'            =>  'Grup koin',
        'Create Reseller Rank'  =>  'Buat peringkat agen',
        'Password'              =>  'Katasandi',
        'Identity Card'         =>  'Kartu identitas',
        'Access denied'         =>  'Akses ditolak',
        'You cant access'       =>  'Anda tidak dapat mengakses',
        'Create new asset'      =>  'Buat asset baru',
        'Link'                  =>  'Link',
        'Version'               =>  'Versi',
        'Edit Asset'            =>  'Edit asset',
        'Choose a file'         =>  'pilih file',
        'Create new reseller'   =>  'buat agen baru',
        'Select All'            =>  'Pilih semua',
        'Weekly'                =>  'Mingguan',
        'Monthly'               =>  'Bulanan',
        'Create new'            =>  'Buat baru',
 

    
    ];
    return $array_menuContent[$menu];
}


function ConfigTextTranslate($menu){

    $array_menuContent = [

        "The Menu Can't be Accessed and can't be edited"    =>   "Menu tidak dapat diakses dan tidak dapat diubah",
        "The Menu Can be Accessed and can't be edited"      =>   "Menu dapat diakses dan tidak dapat diubah",
        "The Menu Can be Accessed and edited"               =>   "Menu dapat diakses dan dapat di ubah",
        "Login"                                             =>   "Masuk",
        "Logout"                                            =>   "Keluar",
        "pending"                                           =>   "Tunda",
        "Success"                                           =>   "Sukses",
        "Failed"                                            =>   "Gagal",
        "Bet"                                               =>   "Taruhan",
        "Win"                                               =>   "Menang",
        "Lose"                                              =>   "Kalah",
        "Transfer Out"                                      =>   "Transfer Out",
        "Free"                                              =>   "Gratis",
        "Bonus"                                             =>   "Bonus",
        "Gift"                                              =>   "Hadiah",
        "Reward"                                            =>   "Penghargaan",
        "Buy"                                               =>   "Beli",
        "Player"                                            =>   "Pemain",
        "Guest"                                             =>   "Guest",
        "Bot"                                               =>   "Bot",
        "Disabled"                                          =>   "Non aktif",
        "Enabled"                                           =>   "Aktif",
        "Chip"                                              =>   "Chip",
        "Gold"                                              =>   "Koin",
        "Good"                                              =>   "Barang",
        //"1"                                                 =>  "1",
        "" => ""

    ];
    return $array_menuContent[$menu];
};

function alertTranslate($menu){

    $array_menuContent = [

        "insert data successful"                                        =>  "memasukan data berhasil",
        "Successful image"                                              =>  "Gambar berhasil",
        "Failed"                                                        =>  "Gagal",
        "end date can't be less than start date"                        =>  "Tanggal akhir tidak boleh sebelum tanggal mulai",
        "balance cannot be reduced"                                     =>  "balance tidak dapat dikurangi",
        "balance cannot be reduced, please enter the appropriate amount"=>  "balance tidak dapat dikurangi, silahkan masukan nominal yang sesuai",
        "Successful update"                                             =>  "Update sukses",
        "Name can't be NULL"                                            =>  "Nama tidak bisa menjadi NULL",
        "File extensions are not allowed, you must use .jpg"            =>  "Ekstensi file tidak diperbolehkan, harus menggunakan .jpg",
        "Update image successfull"                                      =>  "Update gambar sukses",
        "format must be jpg and pictorial"                              =>  "Format gambar harus jpg",
        "Data deleted"                                                  =>  "Data terhapus",
        "Something wrong"                                               =>  "Ada sesuatu yang salah",
        "Min Date And Max Date Must be Filled In"                       =>  "Minimum tanggal dan maksimal tanggal harus di isi",
        "Data Added"                                                    =>  "Data ditambahkan",
        "Max Buy can't be under Min Buy"                                =>  "Max buy tidak bisa dibawah Min buy",
        "Size Image it's too Big"                                       =>  "Ukuran gambar terlalu besar",
        "Image must be in png"                                          =>  "Gambar harus berformat png",
        "Price can't be NULL"                                           =>  "Harga tidak bisa NULL",
        "File extensions are not allowed"                               =>  "Ekstensi file tidak diperbolehkan",
        "Data Updated"                                                  =>  "Data diperbarui",
        "Update can't be process"                                       =>  "Data tidak dapat diproses",
        "Category can't be NULL"                                        =>  "Kategori tidak dapat NULL",
        "Your image source size height is more than 319 px and width is more than 384" => "Tinggi ukuran sumber gambar Anda lebih dari 319 px dan lebar lebih dari 384",
        "format must be png and pictorial"                              =>  "Format gambar harus png",
        "ID must be fill"                                               =>  "ID harus diisi",
        "Username or Password are wrong!!"                              =>  "Username dan katasandi salah!!",
        "You are already Log Out"                                       =>  "Kamu sudah keluar",
        "Update status successfull"                                     =>  "Memperbarui status berhasil",
        "Input Data successfull with"                                   =>  "Input data berhasil dengan",
        "Number of inputs filled in player ID can't be NULL"            =>  "Jumlah input yang diisi ID pemain tidak boleh NULL",
        "You must to Choose Status"                                     =>  "Kamu harus memilih status",
        "Data input successfull"                                        =>  "Data berhasil di input", 
        "Reset Password Successfully"                                   =>  "Setel ulang password berhasil",
        "Password is NULL"                                              =>  "Katasandi NULL",
        "REGISTER SUCCESSFULL"                                          =>  "Pendaftaran sukses",
        "Approved Successful"                                           =>  "BERHASIL DISETUJUI",
        "Declined Successful"                                           =>  "DITOLAK BERHASIL",
        "File size too large"                                           =>  "Ukuran file terlalu besar",
        "Receiving request Transaction has been successful"             =>  "Menerima permintaan transaksi telah berhasil",
        "Reject request Transaction has been successful"                =>  "Menolak permintaan transaksi telah berhasil",
        "Role Name is Null"                                             =>  "Nama peran NULL",
        "your Big blind can't be under Minbuy divided 10 "              =>  "Big blind Anda tidak dapat berada di bawah Minbuy dibagi 10",
        "your Small Blind can't be under Big Blind divided 2 "          =>  "Small blind Anda tidak dapat berada di bawah Big Blind dibagi 2",
        "Min buy table can't be under Min Buy room"                     =>  "Table min buy tidak boleh dibawah room min buy",
        "Max buy table can't be up to max buy room"                     =>  "Table max buy tidak bisa sampai dengan room max buy",
        "Min Buy can't be under Stake multiplied by 3 multiplied 13 or under "  =>  "Min Buy tidak bisa di bawah stake yang dikalikan dengan 3 kali 13 atau di bawah",
        "Max buy can't be under min buy"                                =>  "Max buy tidak bisa dibawah min buy",
        "Min buy can't be under max buy"                                =>  "Min buy tidak bisa dibawah max buy",
        "Max buy can't be up to max buy room"                           =>  "Max buy tidak bisa sampai room max buy",
        "Max buy can't be under Stake multiplied by 10 or under "       =>  "Max buy tidak bisa dibawah stake dikalikan 10 atau dibawahnya",
        "Max buy can't be under Min buy multiplied by 4 or under "      =>  "Max buy tidak bisa dibawah Min buy dikalikan 4 atau dibawahnya",
        "Min buy can't be under stake multiplied by 10 or under"        =>  "Min buy tidak bisa dibawah stake dikalikan 10 atau dibawahnya",
        "Max buy can't be under Min Buy multiplied by 2 or under"       =>  "Max buy tidak bisa dibawah Min buy dikalikan 2 atau dibawahnya",
        "your Small Blind can't be under Big Blind divided 2 or under"  =>  "Small blind mu tidak bisa dibawah Big blind dibagi 2 atau dibawahnya",
        "Min buy can't be under to min buy room "                       =>  "Min buy tidak bisa dibawah room min buy",
        "Max Buy can't be under Stake multiplied by 4 or under "        =>  "Max buy tidak bisa dibawah stake dikali 4 atau dibawahnya",
        ""


        

        

        

    ];
    return $array_menuContent[$menu];
};




?>