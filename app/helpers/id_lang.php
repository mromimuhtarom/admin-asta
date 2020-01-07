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
      'User_Bank_Transaction'           =>  'Transaksi Bank Pengguna',
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
        'View & Edit'                   =>  'Lihat dan hapus',
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
        'Detail Information'    =>  'Informasi detail',
        'buy'                   =>  'membeli',
        'using'                 =>  'menggunakan',
        'at price'              =>  'pada harga',
        'Awarded'               =>  'hadiah',
        'Type'                  =>  'tipe',
        'Status'                =>  'Status',
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
        'Date'                  =>  'Tanggal',
        'Win'                   =>  'Menang',
        'Lose'                  =>  'Kalah',
        'Turn Over'             =>  'Turn Over',
        'Fee'                   =>  'Biaya',
        'Yes'                   =>  'Ya',
        'No'                    =>  'Tidak',
        'pending'               =>  'Tunda',
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
    ];

    return $array_menuContent[$menu];

}


function TranslateMenuGame($menu){

    $array_menuContent = [
        'Table'             => 'Table',
        'Table Player'      => 'Table pemain',
        'Change Title'      => 'Ganti  nama',
        'Create New Table'  => 'Buat table baru', 
        'Table Name'        => 'Nama table',
        'Group'             => 'Grup',
        'Max Player'        => 'Pemain maks',
        'Small Blind'       => 'Small blind',
        'Big Blind'         => 'Big blind',
        'Jackpot'           => 'Jackpot',
        'Min Buy'           => 'Minimal beli',
        'Max Buy'           => 'Maksimal beli',
        'Timer'             => 'Timer',
        'Action'            => 'Aksi',
        'Create Table'      => 'Buat table',
        'Select Category'   => 'Pilih kategori',
        'Save'              => 'Simpan',
        'Cancel'            => 'Batal',
        'Delete Data'       => 'Hapus data',
        'Are you sure'      => 'Apakah anda yakin ingin menghapusnya?',
        'Yes'               => 'Ya',
        'No'                => 'Tidak',
        'Category'          => 'Kategori',
        'Asta Poker Table'  => 'Asta poker table',
        'Title'             => 'Judul',
        'Create Category'   => 'Buat kategori',
        'Asta Big Two Table'=> 'Asta Big Two table',
        'Create New Table'  => 'Buat table baru',
        'Turn'              => 'Giliran',
        'Total Bet'         => 'Total Taruhan',
        'Stake'             => 'Stake',
        'Timer'             => 'Timer',
        'Game state'        => 'Status permainan',
        'Current turn seat ID'  => 'Giliran ID kursi saat ini',
        'Room Name'         => 'Nama room',
        'Name'              => 'Nama',

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
        'Date Request'      =>  'Tanggal permintaan',
        'Item awarded'      =>  'Item diberikan',

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




?>