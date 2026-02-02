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
    if (laporan === "11") {
        url = '<?php echo base_url("index.php/laporan_eca/CetakLampiranIVB11"); ?>';
    } else if (laporan === "21") {
        url = '<?php echo base_url("index.php/laporan_eca/CetakLampiranIVB21"); ?>';
    } else if (laporan === "23") {
        url = '<?php echo base_url("index.php/laporan_eca/CetakLampiranIVB23"); ?>';
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



    function cetakanpdf(){
        $('#itemsList').combogrid({  
            panelWidth:300,  
            idField:'price',  
            textField:'item',  
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/master/ambil_file_pdf',  
            columns:[[  
                {field:'price',title:'No',width:50},  
                {field:'item',title:'NAMA BULAN',width:250}    
            ]],  
            onSelect:function(rowIndex,rowData){ }  
        });
    }

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
    <h1 align="center"><b>CETAK LAPORAN PENGGUNAAN</b></h1>
    <fieldset>
        <table align="center" style="width:100%;" border="0">
            <select id="itemsList" onchange="gettingList()">
                <option>SILAHKAN PILIH LAPORAN PENGGUNAAN</option>
                <option value="11">LAMPIRAN IV.B.1.1</option>
                <option value="21">LAMPIRAN IV.B.2.1</option>
                <option value="23">LAMPIRAN IV.B.2.3</option>
                <option value="31">LAMPIRAN IV.B.3.1</option>
                <option value="33">LAMPIRAN IV.B.3.3</option>
            </select>

            <input placeholder="Price" type="text" id="price" style="display:none;">
            <input placeholder="Item" type="text" id="item" style="width:50%;" >

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
