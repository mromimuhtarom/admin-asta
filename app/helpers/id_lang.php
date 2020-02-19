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
      'L_DASHBOARD'                     => 'Dasbor',
      'L_ADMIN'                         => 'Admin',
      'L_USER_ADMIN'                    => 'Pengguna Admin',
      'L_ROLE_ADMIN'                    => 'Peran Admin',
      'L_LOG_ADMIN'                     => 'Catatan Admin',
      'L_ACTIVE_ADMIN'                   => 'Admin aktif',
      'L_REPORT_ADMIN'                  => 'Laporan admin',
      'L_TRANSACTION'                   => 'Transaksi',
      'L_TRANSACTION_DAY'               => 'Transaksi Harian',
      'L_USER_BANK_TRANSACTION'         => 'Transaksi Bank Pemain',
      'L_REWARD_TRANSACTION'            => 'Transaksi Barang',
      'L_ADD_TRANSACTION'               => 'Tambah transaksi',
      'L_TRANSACTION_POINT'             => 'Transaksi Point',
      'L_PLAYERS'                       => 'Pemain',
      'L_ACTIVE_PLAYERS'                => 'Pemain aktif',
      'L_REPORT_PLAYERS'                => 'Laporan pemain',
      'L_HIGH_ROLLER'                   => 'High roller',
      'L_REGISTERED_PLAYERS'            => 'Pemain terdaftar',
      'L_GUEST'                         => 'Guest',
      'L_BOTS'                          => 'Bot',
      'L_PLAY_REPORT'                   => 'Laporan permainan',
      'L_CHIP_PLAYERS'                  => 'Chip pemain',
      'L_GOLD_PLAYERS'                  => 'Koin pemain',
      'L_POINT_PLAYERS'                 => 'Poin pemain',
      'L_REGISTER_PLAYER_ID'            => 'ID pemain terdaftar',
      'L_LOG_PLAYER'                    => 'Catatan Pemain',
      'L_TRANSACTION_PLAYERS'           => 'Transaksi pemain',
      'L_PLAYERS_LEVEL'                 => 'Level pemain',
      'L_AVATAR_PLAYER'                 => 'avatar pemain',
      'L_SLIDE_BANNER'                  => 'Slide spanduk',
      'L_ITEM'                          => 'Item',
      'L_TABLE_GIFT'                    => 'Table gift',
      'L_REPORT_GIFT'                   => 'Laporan gift',
      'L_EMOTICON'                      => 'Emoticon',
      'L_GAMES'                         => 'Permainan',
      'L_ASTA_POKER'                    => 'Asta-Poker',
      'L_TABLE_ASTA_POKER'              => 'Table Asta poker',
      'L_CATEGORY_ASTA_POKER'           => 'Kategori',
      'L_SEASON_ASTA_POKER'             => 'Musim Asta Poker',
      'L_SEASON_REWARD_ASTA_POKER'      => 'Hadiah musim Asta Poker',
      'L_TOURNAMENT_ASTA_POKER'         => 'Turnamen Asta Poker',
      'L_JACKPOT_PAYTABLE_ASTA_POKER'   => 'Jackpot Paytable Asta Poker',
      'L_MONITORING_TABLE_ASTA_POKER'   => 'Monitor Meja',
      'L_BIG_TWO'                       => 'Big Two',
      'L_TABLE_BIG_TWO'                 => 'Table Big Two',
      'L_CATEGORY_BIG_TWO'              => 'Kategori Big Two',
      'L_SEASON_BIG_TWO'                => 'Musim Big Two',
      'L_SEASON_REWARD_BIG _TWO'         => 'Hadiah musim Big Two',
      'L_TOURNAMENT_BIG_TWO'            => 'Turnamen Big Two',
      'L_JACKPOT_PAYTABLE_BIG_TWO'      => 'Jackpot Paytable Big Two',
      'L_DOMINO_SUSUN'                  => 'Domino susun',
      'L_TABLE_DOMINO_SUSUN'            => 'Table domino susun',
      'L_CATEGORY_DOMINO_SUSUN'         => 'Kategori domino susun',
      'L_SEASON_DOMINO_SUSUN'           => 'Musim domino susun',
      'L_SEASON_REWARD_DOMINO_SUSUN'    => 'Hadiah musim Domino susun',
      'L_TOURNAMENT_DOMINO_SUSUN'       => 'Turnamen Domino susun',
      'L_JACKPOT_PAYTABLE_DOMINO_SUSUN' => 'Jackpot paytable Domino susun',
      'L_DOMINO_QQ'                     => 'Domino-QQ',
      'L_TABLE_DOMINO_QQ'               => 'Table Domino-QQ',
      'L_CATEGORY_DOMINO_QQ'            => 'Kategori Domino-QQ',
      'L_SEASON_DOMINO_QQ'              => 'Musim Domino-QQ',
      'L_SEASON_REWARD_DOMINO_QQ'       => 'Hadiah musim Domini-QQ',
      'L_TOURNAMENT_DOMINO_QQ'          => 'Turnamen Domino-QQ',
      'L_JACKPOT_PAYTABLE_DOMINO_QQ'    => 'Jackpot paytable Domino-QQ',
      'L_GAME_SETTING'                  => 'Pengaturan Game',
      'L_STORE'                         => 'Toko',
      'L_BEST_OFFER'                    => 'Penawaran terbaik',
      'L_CHIP_STORE'                    => 'Toko Chip',
      'L_GOLD_STORE'                    => 'Toko Koin',
      'L_GOODS_STORE'                   => 'Toko Barang',
      'L_PAYMENT_STORE'                 => 'Toko Pembayaran',
      'L_REPORT_STORE'                  => 'Laporan Toko',
      'L_NOTIFICATION'                  => 'Pemberitahuan',
      'L_PUSH_NOTIFICATION'             => 'Pemberitahuan push',
      'L_EMAIL_NOTIFICATION'            => 'Pemberitahuan email',
      'L_FEEDBACK'                      => 'Umpan balik',
      'L_REPORT_ABUSE_PLAYER'           => 'Laporan penyalahgunaan pemain',
      'L_ABUSE_TRANSACTION_REPORT'      => 'Laporan penyalahgunaan transaksi',
      'L_FEEDBACK_GAME'                 => 'Umpan balik game',
      'L_SETTINGS'                      => 'Pengaturan',
      'L_GENERAL_SETTING'               => 'Pengaturan umum',
      'L_RESELLER'                      => 'Agen',
      'L_LIST_RESELLER'                 => 'Daftar agen',
      'L_RESELLER_TRANSACTION'          => 'Transaksi Agen',
      'L_TRANSACTION_DAY_RESELLER'      => 'Transaksi Harian Agen',
      'L_REQUEST_TRANSACTION'           => 'Transaksi permintaan',
      'L_ADD_TRANSACTION_RESELLER'      => 'Tambah Transaksi',
      'L_REPORT_TRANSACTION'            => 'Laporan Transaksi Pembelian',
      'L_BALANCE_RESELLER'              => 'Saldo agen',
      'L_ITEM_STORE_RESELLER'           => 'Toko item agen',
      'L_RESELLER_RANK'                 => 'Rank agen',
      'L_REGISTER_RESELLER'             => 'Pendaftaran agen',
      'L_VERSION_ASSET_APK'             => 'Versi asset apk',
      'L_LOG_OUT'                        => 'Keluar',
      'L_MONITORING_TABLE_DOMINO_SUSUN'      => 'Monitor Meja',
      'L_MONITORING_TABLE_DOMINO_QQ'      => 'Monitoring Meja',
      'L_MONITORING_TABLE_BIG_TWO'      => 'Monitor Meja',
      'L_STORE_RESELLER'                => 'Toko Agen',
      'L_STORE_RESELLER_REPORT'         => 'Laporan Toko Agen'
      
    ];

    return $array_menu[$menu];
}


//=================================MENU ADMIN===============================//
function translate_MenuContentAdmin($menu){
    
    $array_menuContent = [

        'L_ADMIN'                => 'Admin',
        'L_ROLE_ADMIN'           => 'Peran Admin',
        'Log Admin'              => 'Catatan Admin',
        'Active Admin'           => 'Admin aktif',
        'Report Admin'           => 'Laporan Admin',
        'L_CREATE_USER_ADMIN'    => 'Buat Admin',
        'L_CREATE_ROLE_ADMIN'    => 'Buat peran admin',
        'L_CHOOSE_ACTION'        => 'Pilih Aksi',
        'Create Admin'           => 'Buat admin',
        'Delete Admin'           => 'Hapus admin',
        'Edit Admin'             => 'Edit admin',
        'Decline Admin'          => 'Tolak admin',
        'Approve Admin'          => 'Terima admin',
        'Change Password Admin'  => 'Ganti katasandi admin',
        'Choose Role'            => 'Pilih peran',
        'L_CHOOSE_LOG_TYPE'      => 'Pilih Tipe Log',
        'L_PLAYERS_ONLINE'       => 'Pemain online',
        'L_SAVE'                 => 'Simpan',
        'L_SEARCH'               => 'Cari',
        'L_CANCEL'               => 'Batal',
        'L_CREATE_NEW_USER'      => 'Buat pengguna baru',
        'Create New Role'        => 'Buat peran baru',
        'L_SELECT_ALL'           => 'Pilih semua',
        'L_ADMIN_ID'             => 'ID Admin',
        'L_ADMIN_REPORT'         => 'Laporan admin',
        'Player ID'              => 'ID pemain',
        'L_STATUS'               => 'Status',
        'L_ROLE_NAME'            => 'Nama peran',
        'L_USERNAME'             => 'Pengguna Admin',
        "L_FULLNAME"             => "Nama Lengkap",
        "L_ROLE_TYPE"            => "Tipe Peran",
        'Date'                   => 'Tanggal',
        'L_DATE_LOGIN'           => 'Tanggal login',
        'L_TIMESTAMP'            => 'Waktu',
        'L_IP'                   => 'IP',
        'Description'            => 'Deskripsi',
        'L_ACTION'               => 'Aksi',
        'L_RESET_PASSWORD'       => 'Reset Katasandi',
        'L_DELETE_DATA'          => 'Hapus data',
        'L_VIEW_EDIT'            => 'Lihat dan Edit',
        'L_QUESTION_DELETE'      => 'Apakah anda yakin akan mengahusnya?',
        'L_YES'                  => 'Ya',
        'L_NO'                   => 'Tidak',
        'L_STATEMENT_DELETE_ALL' => 'Hapus semua data terpilih?',
        'L_QUESTION_DELETE_ALL'  => 'Apakah anda yakin akan menghapus semua data yang dipilih?',
        'L_DESCRIPTION_NULL'     => 'Deskripsi tidak boleh kosong'
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
        'Choose Game'           =>  'Pilih Game',
        'All Game'              =>  'Semua Game',
        'Today'                 =>  'Hari ini',
        'Day'                   =>  'Harian',
        'Week'                  =>  'Mingguan',
        'Month'                 =>  'Bulanan',
        'All time'              =>  'Sepanjang waktu',
        'Game'                  =>  'Permainan',
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
        'Win Lose'              =>  'Menang Kalah',
        'Cash Debit'            =>  'Debit Tunai',
        'Cash Credit'           =>  'Kredit Tunai',
        'Gold Debit'            =>  'Debit Koin',
        'Gold Credit'           =>  'Kredit Koin',
        'Chip Debit'            =>  'Debit Chip',
        'Chip Credit'           =>  'Kredit Chip',
        'Reward Gold'           =>  'Reward Koin',
        'Reward Chip'           =>  'Reward Chip',
        'Reward Point'          =>  'Reward Poin',
        'Correction Gold'       =>  'Koreksi Koin',
        'Correction Chip'       =>  'Koreksi Chip',
        'Correction Point'      =>  'Koreksi Poin', 
        'Point Get'             =>  'Point Di Dapat',
        'Point Spend'           =>  'Poin Di Pakai',
        'Point Expired'         =>  'Poin Kadaluarsa',
        'Transaction Day'       =>  'Transaksi Harian',
        'Detail Information'    =>  'Detail Information',
        'Are you sure want to Decline this Transaction' => 'aaa' ,
        'Are you want to Approve this Transaction?'    => 'cc',
        'L_TRANSPLAYER'         =>  'Transaksi pemain'
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
        'L_ALLGAMES'                =>  'Semua game',
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
        'Device Timer'              =>  'Tanggal kedaluarsa',
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
        'L_PLAYER'                  =>  'Pemain',
        'L_GUEST'                     =>  'Guest',
        'L_APPROVE'                 =>  'Setuju',
        'L_BANNED'                  =>  'Dilarang',
        'L_PROBLEM'                 =>  'Bermasalah',
        'Save'                      =>  'Simpan',
        'Cancel'                    =>  'Cancel',
        'Players level'             =>  'Level pemain',
        'Create player level'       =>  'Buat level pemain',
        'Level'                     =>  'Maks Level',
        'Experience'                =>  'Maks Pengalaman',
        'Player Rank'               =>  'Peringkat pemain',
        'Create Rank Player'        =>  'Buat peringkat pemain',
        'Save Avatar'               =>  'Simpan avatar',
        'Edit Avatar'               =>  'Ubah avatar',
        'Edit'                      =>  'Edit',
        'Main'                      =>  'Utama',
        'Confirmation'              =>  'Konfirmasi',
        'Lobby'                     =>  'Lobi',
        'Create new avatar'         =>  'Buat avatar baru',
        'Avatar player'             =>  'Avatar pemain'     

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
        'Edit Gift'         =>  'Ubah gift',
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
        'Date'              =>  'Tanggal',
        'Description'       =>  'Deskripsi',
        'Emoticon'          =>  'Emoticon',
        'Create New Emoticon'=> 'Buat emotikon baru',
        'Create Emoticon'   =>  'Buat emotikon',
        'Edit'              =>  'Ubah',
        'Gift ID'           =>  'ID Gift',
        'Emoticon ID'       =>  'Emotikon ID',
        'See Detail Image'  =>  'Lihat Detail Gambar / Gif',
        'Detail Info'       =>  'preview gambar',
        'Detail Image'      =>  'Detail Gambar'
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
        'Asta Poker Table'     => 'Asta Poker Meja',
        'Title'                => 'Judul',
        'Create Category'      => 'Buat kategori',
        'Asta Big Two Table'   => 'Asta Big Two Meja',
        'L_ASTA_DOMINO_QQ_TABLE' => 'Asta Domino QQ Meja',
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
        'Upload File Language' => 'Unduh File Bahasa',
        'Table Name'           => 'Nama Meja',
        'Play Time'            => 'Waktu Bermain',
        'Seat'                 => 'Kursi',
        'Username Player'      => 'Nama Pengguna Pemain',
        'See Detail'           => 'Lihat Detail',
        'See'                  => 'Lihat',
        'Online'               => 'Daring',
        'Players'              => 'Pemain',
        'Refresh'              => 'Refresh',
        'Auto Refresh'         => 'Refresh Otomatis',
        'Novice'               => 'Pemula',
        'Intermediate'         => 'Menengah',
        'Pro'                  => 'Ahli'  

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
        'Payment Type'      =>  'Tipe Pembayaran',

    ];

    return $array_menuContent[$menu];
}


function TranslateMenuFeedback($menu){

    $array_menuContent = [

        'Feedback'                  =>  'Umpan balik',
        'Abuse Transaction Report'  =>  'Laporan penyalahgunaan Transaksi',
        'Report Abuse Player'       =>  'Laporan penyalahgunaan pemain',
        'Image Proof'               =>  'Bukti gambar',
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
        'Edit privacy & policy'     =>  'Ubah Kebijakan dan privasi',
        'Edit Term of Service'      =>  'Ubah Ketentuan pelayanan',
        'days'                      =>  'Hari',
        'Edit Asta Poker'           =>  'Ubah Asta Poker',
        'Edit Big Two'              =>  'Ubah Big two',
        'Edit Domino QQ'            =>  'Ubah Domino QQ',
        'Edit Domino Susun'         =>  'Ubah Domino susun',
        

    ];
    return $array_menuContent[$menu];
}

function TranslateReseller($menu){

    $array_menuContent = [

        'Reseller ID'            => 'ID agen',
        'Phone'                  => 'Telefon',
        'Saldo gold'             => 'Saldo koin',
        'Report Transaction'     => 'Laporan transaksi',
        'Bonus Item'             => 'Bonus item',
        'Balance'                => 'Saldo',
        'Gold Group'             => 'Grup koin',
        'Create Reseller Rank'   => 'Buat peringkat agen',
        'Password'               => 'Katasandi',
        'Identity Card'          => 'Kartu identitas',
        'Access denied'          => 'Akses ditolak',
        'You cant access'        => 'Anda tidak dapat mengakses',
        'Create new asset'       => 'Buat asset baru',
        'Link'                   => 'Link',
        'Version'                => 'Versi',
        'Edit Asset'             => 'Edit asset',
        'Choose a file'          => 'pilih file',
        'Create new reseller'    => 'buat agen baru',
        'Select All'             => 'Pilih semua',
        'L_WEEKLY'               => 'Mingguan',
        'L_MONTHLY'              => 'Bulanan',
        'Create new'             => 'Buat baru',
        'Username / Reseller ID' => 'Nama Agent / ID Agen',
        'Gold'                   => 'Koin',
        'Reason Gold Is Minus'   => 'Alasan Koin dikurangi',
        'Date Created'           => 'Tanggal',
        'Buy Gold'               => 'Beli Koin',
        'Buy Amount'             => 'Jumlah Pembelian',
        'Sell Gold'              => 'Jual Koin',
        'Reward Gold'            => 'Reward Koin',
        'Correction Gold'        => 'Koreksi Koin',
        'Username'               => 'Nama Reseller',
        'Reseller ID'            => 'ID Agen',
        'Add Transaction Gold'   => 'Tambah Transaksi Koin'

    
    ];
    return $array_menuContent[$menu];
}


function ConfigTextTranslate($menu){

    $array_menuContent = [

        "L_CAN'T_ACCESSED_AND_CAN'T_EDITED"    =>   "Menu tidak dapat diakses dan tidak dapat diubah",
        "L_CAN_ACCESSED_AND_CAN'T_EDITED"      =>   "Menu dapat diakses dan tidak dapat diubah",
        "L_CAN_ACCESSED_EDITED"                =>   "Menu dapat diakses dan dapat di ubah",
        "L_LOGIN"                                             =>   "Masuk",
        "L_LOGOUT"                                            =>   "Keluar",
        "L_PENDING"                                           =>   "Tunda",
        "L_SUCCESS"                                           =>   "Sukses",
        "L_FAILED"                                            =>   "Gagal",
        "L_BET"                                               =>   "Taruhan",
        "L_WIN"                                               =>   "Menang",
        "L_LOSE"                                              =>   "Kalah",
        "L_DRAW"                                              =>   "Seri",
        "L_TRANSFER_IN"                                       =>   "Transfer masuk",
        "L_TRANSFER_OUT"                                      =>   "Transfer Keluar",
        "L_FREE"                                              =>   "Gratis",
        "L_BONUS"                                             =>   "Bonus",
        "L_GIFT"                                              =>   "Hadiah",
        "L_REWARD"                                            =>   "Penghargaan",
        "L_BUY"                                               =>   "Beli",
        "L_PLAYER"                                            =>   "Pemain",
        "L_GUEST"                                             =>   "Guest",
        "L_BOT"                                               =>   "Bot",
        "L_DISABLED"                                          =>   "Non aktif",
        "L_ENABLED"                                           =>   "Aktif",
        "L_CHIP"                                              =>   "Chip",
        "L_GOLD"                                              =>   "Koin",
        "L_GOOD"                                              =>   "Barang",
        "L_FOOD"                                              =>   "Makanan",
        "L_DRINK"                                             =>   "Minuman",
        "L_ITEM"                                              =>   "Item",
        "L_ACTION"                                            =>   "Aksi",
        "L_CORRECTION"                                        =>   "Koreksi",
        "L_ADJUST"                                            =>   "Penyesuaian",
        "Lose"                                                =>   "Kalah",
        "Win"                                                 =>   "Menang",
        // "1"                                                 =>  "1",
        "" => ""

    ];
    return $array_menuContent[$menu];
};

function alertTranslate($menu){

    $array_menuContent = [

        "insert data successful"                                        =>  "memasukan data berhasil",
        'L_INSERT_SUCCESSFULL'                                          =>  "Memasukan data berhasil",
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
        "Input Data successfull with "                                  =>  "Input data berhasil dengan",
        "Number of inputs filled in player ID can't be NULL"            =>  "Jumlah input yang diisi ID pemain tidak boleh NULL",
        "You must to Choose Status"                                     =>  "Kamu harus memilih status",
        "Data input successfull"                                        =>  "Data berhasil di input", 
        "L_RESET_PASSWORD_SUCCESS"                                   =>  "Setel ulang password berhasil",
        "L_PASSWORD_NULL"                                              =>  "Katasandi NULL",
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
        "Max buy can't be under Stake multiplied by 2 or under"         =>  "Max buy tidak bisa dibawah Stake dikalikan 2 atau dibawahnya",
        "Min buy can't be under to min buy room "                       =>  "Min buy tidak bisa dibawah room min buy",
        "Max Buy can't be under Stake multiplied by 4 or under "        =>  "Max buy tidak bisa dibawah stake dikali 4 atau dibawahnya",
        "Max Buy table can't be Up to Max Buy room"                     =>  "table max buy tidak bisa diatas room max buy",
        "You didn't allow to delete your account"                       =>  "Kamu tidak diperbolehkan menghapus akunmu",
        "Data saved"                                                    =>  "Data tersimpan!",
        "Data added"                                                    =>  "Data berhasil di tambahkan",
        "Operator Still use this role, wait until role didnott use"     =>  "Operator masih menggunakan peran ini, tunggu peran ini tidak dipakai",
        "For Type Adjust number didnot allowed negative"  =>  "Untuk tipe penyesuaian nomor tidak boleh negatif",
        "For type Bonus or Free number not allowed negative number"     =>  "Untuk tipe Bonus atau Gratis nomornya tidak diperbolehkan negatif",
        "User ID"                                                       =>  "ID Pengguna",
        "Balance Chip"                                                  =>  "Saldo chip",
        "Balance Point"                                                 =>  "Saldo Point",
        "Balance Gold"                                                  =>  "Saldo Koin",
        "Transaction Chip"                                              =>  "Transaksi Chip",
        "Transaction Gold"                                              =>  "Transaksi Koin",
        "Transaction Point"                                             =>  "Transaksi Poin",
        "L_PASSWORD_FAILED"                                             =>  "Password tidak cocok silahkan coba lagi",
        "L_LOGOUT_CHANGE_PASSWORD"                                      =>  "Password anda telah di ganti"
    ];
    return $array_menuContent[$menu];
};

function Translateaction_id($menu){

    $array_menuContent  =   [
        
        "Change Password Admin"     =>      "Ubah password admin",
        "Edit Admin"                =>      "Ubah admin",
        "Create Admin"              =>      "Buat admin",
        "Delete Admin"              =>      "Hapus admin",
        "Approve Admin"             =>      "Setujui admin",
        "Decline Admin"             =>      "Tolak admin",
        "Log In Admin"              =>      "Admin login",
        "Log Out Admin"             =>      "Admin logout",
        "Buy chip with gold"        =>      "Beli chip dengan koin",
        "Daily Award"               =>      "Hadiah harian",
        "Bot Join Table"            =>      "Bot join Table",
        "Join Game"                 =>      "Bergabung dengan game",
        "Sitout Game"               =>      "Sitout Game",
        "Register User"             =>      "Daftar Pengguna",
        "Give Gold"                 =>      "Beri Koin",
        "Buy Gold"                  =>      "Beli Koin",
        "Skilled Bonus Gold"        =>      "Bonus Koin Ahli",
        "Newbie Bonus Gold"         =>      "Bonus Koin Pemula",
        "Create Player"             =>      "Buat Pemain",
        "Delete Player"             =>      "Hapus Pemain",
        "Edit Player"               =>      "Ubah Pemain",
        "Change Password Player"    =>      "Ubah Password Pemain",
        "Login Player"              =>      "Pemain login",
        "Approve Account Player"    =>      "Akun pemain disetujui",
        "Banned Account Player"     =>      "Akun pemain terlarang",
        "Problem Account Player"    =>      "Akun pemain bermasalah",
        "Upgrade Account"           =>      "Tingkatkan akun"
    ];
    return $array_menuContent[$menu];
};

function TranslateTransactionHist($menu){

    $array_menuContent = [
        
        "success"                   =>  "sukses",
        "pending"                   =>  "tunda",
        "Decline"                   =>  "ditolak",
        "Approve"                   =>  "disetujui",
        "GPA.3355-0553-1720-23050"  =>  "GPA.3355-0553-1720-23050",
        "nothing"                   =>  "tidak ada",
        "tidak jelas"               =>  "tidak jelas",
    

    ];
    return $array_menuContent[$menu];
};

function TranslateTransaksiAgen($menu){

    $array_menuContent = [
        
        "Purchase Date"   =>  "Tgl & Waktu pembelian",
        "User ID"         =>  "ID Pengguna",
        "ID Order"        =>  "ID Agen",
        "Transaction Type"=>  "Tipe transaksi"


    ];
    return $array_menuContent[$menu];
};


function TranslateVersionAsetApk($menu)
{
    $array_menuContent = [
        
        "L_IMAGE"   =>  "Gambar",
        "L_AUDIO"   =>  "Suara",
        "L_SCENE"   =>  "Scene"   


    ];
    return $array_menuContent[$menu];
}


function TranslatePlaceholdertxt($placeholder) {
    $array_menuContent = [
        
        "L_PASSWORD"             => "Kata Sandi",
        "L_PASSWORD_WANT_CHANGE" => "Kata Sandi yang mau di ganti",
        "L_PASSWORD_SELF"        => "Massukan Kata Sandi yang sedang login",
        "L_CHOOSE_ROLE_ADMIN"    => "Pilih tipe peran",
        "L_CHOOSE_TYPE"          => "Pilih tipe"


    ];
    return $array_menuContent[$placeholder];
}

function TranslateChoices($menu) {
    $array_menuContent = [

        "L_CHOOSE_TIMER"    =>  "Pilih waktu",
        "L_CHOOSE_CATEGORY" =>  "Pilih kategori",
        ""
    ];
    return $array_menuContent[$menu];
}

function TranslateColumnName($menu) {
    $array_menuContent = [

        "L_FULLNAME"    =>  "Nama Lengkap",
        "L_ROLETYPE" =>  "Tipe Peran",
        ""
    ];
    return $array_menuContent[$menu];
}



?>