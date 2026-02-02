<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    $(document).ready(function() {
        tahun();          
        bulan();

        $('#tgl_cetak').datebox({  
            required:true,
            formatter :function(date){
                var y = date.getFullYear();
                var m = date.getMonth()+1;
                var d = date.getDate();
                return y+'-'+m+'-'+d;
            }
        }); 

        $('#tgl_cetak').datebox('setValue','<?php echo date('Y-m-d')?>');
    });

    $("#price").hide();

    function gettingList() {
        let itemsList = document.querySelector('#itemsList');
        let price = itemsList.value;
        let item = itemsList.options[itemsList.selectedIndex].text;
    
        document.querySelector("#price").value = price;
        document.querySelector("#item").value = item;
    
        console.log(price, item);
    }
    
    function cetak(format) {

    let laporan = document.getElementById('itemsList').value;
    let bulan   = $('#bulan').combogrid('getValue');
    let tahun   = $('#tahun').combogrid('getValue');
    let tgl     = $('#tgl_cetak').datebox('getValue');

    if (!laporan || laporan === 'SILAHKAN PILIH LAPORAN PENGGUNAAN') {
        alert('Pilih laporan dulu');
        return false;
    }

    let jenis = '';

    if (format == 1) jenis = 'pdf';
    if (format == 2) jenis = 'excel';
    if (format == 3) jenis = 'word';
    if (format == 4) jenis = 'html';

    let url = '';

    // contoh: Lampiran IV.B.1.1
    if (laporan === "111") {
        url = '<?php echo base_url("index.php/laporan_eca/CetakLampiranIV111"); ?>';
    } else if (laporan === "121") {
        url = '<?php echo base_url("index.php/laporan_eca/CetakLampiranIV121"); ?>';
    } else if (laporan === "122") {
        url = '<?php echo base_url("index.php/laporan_eca/CetakLampiranIV122"); ?>';
    }

    if (url !== '') {
        url += '?laporan=' + laporan
            + '&bulan=' + bulan
            + '&tahun=' + tahun
            + '&tgl=' + tgl
            + '&jenis=' + jenis;

        window.open(url, '_blank');
    }

    return false;
}


    // function cetak(format) {
    //     gettingList();

    //     var urut = document.querySelector("#price").value;
    //     var docLocation;

    //     if (urut == 111) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.1.1.1';
    //     } else if (urut == 121) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.1.2.1';
    //     } else if (urut == 122) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.1.2.2';
    //     } else if (urut == 131) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.1.3.1';
    //     } else if (urut == 21) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.2.1';
    //     } else if (urut == 31) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.3.1';
    //     } else if (urut == 41) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.4.1';
    //     } else if (urut == 51) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.5.1';
    //     } else if (urut == 61) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.6.1';
    //     } else if (urut == 71) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.7.1';
    //     } else if (urut == 81) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.8.1';
    //     } else if (urut == 91) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.9.1';
    //     } else if (urut == 101) {
    //         docLocation = 'http://10.10.11.44/simbakda_2024/laporan/a. Laporan Perolehan atau Penerimaan IV.A/LAMPIRAN IV.A.10.1';
    //     } else {
    //         alert('cek pilihan cetakan');
    //         return;
    //     }

    //     // Tambahkan ekstensi file sesuai format yang dipilih
    //     switch (format) {
    //         case 1: // PDF
    //             docLocation += '.pdf';
    //             break;
    //         case 2: // Excel
    //             docLocation += '.xlsx';
    //             break;
    //         case 3: // Word
    //             docLocation += '.docx';
    //             break;
    //         case 4: // HTML
    //             docLocation += '.html';
    //             break;
    //         default:
    //             alert('Format tidak valid');
    //             return;
    //     }

    //     window.open(docLocation, "resizeable,scrollbar");
    // }


    // function cetakanpdf(){
    //     $('#itemsList').combogrid({  
    //         panelWidth:300,  
    //         idField:'price',  
    //         textField:'item',  
    //         mode:'remote',
    //         url:'<?php echo base_url(); ?>index.php/master/ambil_file_pdf',  
    //         columns:[[  
    //             {field:'price',title:'No',width:50},  
    //             {field:'item',title:'NAMA BULAN',width:250}    
    //         ]],  
    //         onSelect:function(rowIndex,rowData){ }  
    //     });
    // }


    function bulan(){
        $('#bulan').combogrid({  
            panelWidth:300,  
            idField:'n_bulan',  
            textField:'bulan',  
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/master/ambil_bulan',  
            columns:[[  
                {field:'n_bulan',title:'No',width:50},  
                {field:'bulan',title:'NAMA BULAN',width:250}    
            ]],  
            onSelect:function(rowIndex,rowData){ }  
        });
    }

    function tahun(){
        $('#tahun').combogrid({  
            panelWidth:100,  
            idField:'tahun',  
            textField:'tahun',  
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/master/tahun',  
            columns:[[  
                {field:'tahun',title:'TAHUN',width:50}    
            ]],  
            onSelect:function(rowIndex,rowData){ }  
        });
    }
</script>

<div id="content1"> 
    <h1 align="center"><b>CETAK LAPORAN PEROLEHAN / PENERIMAAN</b></h1>
    <fieldset>
        <table align="center" style="width:100%;" border="0">
            <select id="itemsList" onchange="gettingList()">
                <option>SILAHKAN PILIH LAPORAN PEROLEHAN-PENERIMAAN</option>
                <option value="111">FORMAT IV.A.1.1.1</option>
                <option value="121">FORMAT IV.A.1.2.1</option>
                <option value="122">FORMAT IV.A.1.2.2</option>
                <option value="131">FORMAT IV.A.1.3.1</option>
                <option value="21">FORMAT IV.A.2.1</option>
                <option value="31">FORMAT IV.A.3.1</option>
                <option value="41">FORMAT IV.A.4.1</option>
                <option value="51">FORMAT IV.A.5.1</option>
                <option value="61">FORMAT IV.A.6.1</option>
                <option value="71">FORMAT IV.A.7.1</option>
                <option value="81">FORMAT IV.A.8.1</option>
                <option value="91">FORMAT IV.A.9.1</option>
                <option value="101">FORMAT IV.A.10.1</option>
            </select>

            <input placeholder="Price" type="text" id="price" style="display:none;">
            <input placeholder="Item" type="text" id="item" style="width:50%;" disabled>

            <tr>
                <td colspan="3">
                    <div id="div_bulan">
                        <table style="width:100%;" border="0">
                            <td width="20%">BULAN</td>
                            <td width="1%">:</td>
                            <td width="79%"><input name="bulan" id="bulan" style="width: 150px;"></td>
                        </table>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div id="div_tahun">
                        <table style="width:100%;" border="0">
                            <td width="20%">TAHUN</td>
                            <td width="1%">:</td>
                            <td width="79%"><input name="tahun" id="tahun" style="width: 150px;"></td>
                        </table>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div id="div_tgl">
                        <table style="width:100%;" border="0">
                            <td width="20%">TANGGAL CETAK</td>
                            <td width="1%">:</td>
                            <td width="79%"><input type="text" id="tgl_cetak" name="tgl_cetak" style="width: 150px;"></td>
                        </table>
                    </div>
                </td>
            </tr>

            <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
              <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
              <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
              <tr><td colspan="3">&nbsp;</td></tr>

            <tr>
                <td colspan="3">
                    <div id="div_cetak">
                        <table style="width:100%;" border="0">
                            <td width="20%"></td>
                            <td width="1%"></td>
                            <td width="79%">
                                <a class="easyui-linkbutton" iconCls="icon-pdf" plain="false" onclick="cetak(1);return false;">CETAK PDF</a>
                                <a class="easyui-linkbutton" iconCls="icon-excel" plain="false" onclick="cetak(2);return false;">CETAK EXCEL</a>
                                <a class="easyui-linkbutton" iconCls="icon-word" plain="false" onclick="cetak(3);return false;">CETAK WORD</a>
                                <a class="easyui-linkbutton" iconCls="icon-note_book" plain="false" onclick="cetak(4);return false;">CETAK HTML</a>
                                <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="false">Keluar</a>
                            </td>
                        </table>
                    </div>
                </td>
            </tr>
        </table>  
    </fieldset> 
</div>
