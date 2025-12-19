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

    function cetak(format) {
        gettingList();

        var urut = document.querySelector("#price").value;
        var basePath = 'http://10.10.11.44/simbakda_2024/laporan/l. BMD/';
        var paths = {
            1: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.1.6',
            2: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.1.7',
            3: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.1.8',
            4: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.2.20',
            5: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.2.21',
            6: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.2.22',
            7: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.2.23',
            8: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.2.24',
            9: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.2.25',
           10: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.2.26',
           11: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.3.7',
           12: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.3.8',
           13: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.3.9',
           14: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.1.3.10',
           15: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.2.7',
           16: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.2.8',
           17: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.2.9',
           18: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.2.10',
           19: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.3.7',
           20: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.3.8',
           21: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.3.9',
           22: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.3.10',
           23: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.4.4',
           24: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.4.7',
           25: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.4.8',
           26: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.4.9',
           27: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.4.10',
           28: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.5.7',
           29: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.5.8',
           30: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.5.9',
           31: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.5.10',
           32: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.6.7',
           33: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.6.8',
           34: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.6.9',
           35: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.6.10',
           36: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.7.7',
           37: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.7.8',
           38: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.7.9',
           39: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.7.10',
           40: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.8.7',
           41: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.8.8',
           42: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.8.9',
           43: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.8.10',
           44: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.9.7',
           45: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.9.8',
           46: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.9.9',
           47: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.9.10',
           48: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.10.7',
           49: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.10.8',
           50: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.10.9',
           51: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.10.10',
           52: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.11.5',
           53: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.11.6',
           54: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.11.7',
           55: 'Laporan BMD (Perolehan) LAMPIRAN IV.A.11.8'
        };

        var docLocation = paths[urut];
        
        if (!docLocation) {
            alert('Cek pilihan cetakan');
            return;
        } 

        // Tambahkan basePath ke lokasi dokumen
        docLocation = basePath + docLocation;

        // Tambahkan ekstensi file sesuai format yang dipilih
        switch (format) {
            case 1: // PDF
                docLocation += '.pdf';
                break;
            case 2: // Excel
                docLocation += '.xlsx';
                break;
            case 3: // Word
                docLocation += '.docx';
                break;
            case 4: // HTML
                docLocation += '.html';
                break;
            default:
                alert('Format tidak valid');
                return;
        }

        window.open(docLocation, "resizeable,scrollbar");
    }

    function gettingList() {
        let itemsList = document.querySelector('#itemsList');
        let price = itemsList.value;
        let item = itemsList.options[itemsList.selectedIndex].text;

        document.querySelector("#price").value = price;
        document.querySelector("#item").value = item;

        console.log(price, item);
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
    <h1 align="center"><b>CETAK LAPORAN BMD</b></h1>
    <fieldset>
        <table align="center" style="width:100%;" border="0">
            <select id="itemsList" onchange="gettingList()">
                <option>SILAHKAN PILIH LAPORAN BMD</option>
                <option value="1">LAMPIRAN IV.A.1.1.6</option>
                <option value="2">LAMPIRAN IV.A.1.1.7</option>
                <option value="3">LAMPIRAN IV.A.1.1.8</option>
                <option value="4">LAMPIRAN IV.A.1.2.20</option>
                <option value="5">LAMPIRAN IV.A.1.2.21</option>
                <option value="6">LAMPIRAN IV.A.1.2.22</option>
                <option value="7">LAMPIRAN IV.A.1.2.23</option>
                <option value="8">LAMPIRAN IV.A.1.2.24</option>
                <option value="9">LAMPIRAN IV.A.1.2.25</option>
                <option value="10">LAMPIRAN IV.A.1.2.26</option>
                <option value="11">LAMPIRAN IV.A.1.3.7</option> 
                <option value="12">LAMPIRAN IV.A.1.3.8</option>
                <option value="13">LAMPIRAN IV.A.1.3.9</option>
                <option value="14">LAMPIRAN IV.A.1.3.10</option>
                <option value="15">LAMPIRAN IV.A.2.7</option>
                <option value="16">LAMPIRAN IV.A.2.8</option>
                <option value="17">LAMPIRAN IV.A.2.9</option>
                <option value="18">LAMPIRAN IV.A.2.10</option>
                <option value="19">LAMPIRAN IV.A.3.7</option>
                <option value="20">LAMPIRAN IV.A.3.8</option>
                <option value="21">LAMPIRAN IV.A.3.9</option>
                <option value="22">LAMPIRAN IV.A.3.10</option>
                <option value="23">LAMPIRAN IV.A.4.4</option>
                <option value="24">LAMPIRAN IV.A.4.7</option>
                <option value="25">LAMPIRAN IV.A.4.8</option>
                <option value="26">LAMPIRAN IV.A.4.9</option>
                <option value="27">LAMPIRAN IV.A.4.10</option>
                <option value="28">LAMPIRAN IV.A.5.7</option>
                <option value="29">LAMPIRAN IV.A.5.8</option>
                <option value="30">LAMPIRAN IV.A.5.9</option>
                <option value="31">LAMPIRAN IV.A.5.10</option>
                <option value="32">LAMPIRAN IV.A.6.7</option>
                <option value="33">LAMPIRAN IV.A.6.8</option>
                <option value="34">LAMPIRAN IV.A.6.9</option>
                <option value="35">LAMPIRAN IV.A.6.10</option>
                <option value="36">LAMPIRAN IV.A.7.7</option>
                <option value="37">LAMPIRAN IV.A.7.8</option>
                <option value="38">LAMPIRAN IV.A.7.9</option>
                <option value="39">LAMPIRAN IV.A.7.10</option>
                <option value="40">LAMPIRAN IV.A.8.7</option>
                <option value="41">LAMPIRAN IV.A.8.8</option>
                <option value="42">LAMPIRAN IV.A.8.9</option>
                <option value="43">LAMPIRAN IV.A.8.10</option>
                <option value="44">LAMPIRAN IV.A.9.7</option>
                <option value="45">LAMPIRAN IV.A.9.8</option>
                <option value="46">LAMPIRAN IV.A.9.9</option>
                <option value="47">LAMPIRAN IV.A.9.10</option>
                <option value="48">LAMPIRAN IV.A.10.7</option>
                <option value="49">LAMPIRAN IV.A.10.8</option>
                <option value="50">LAMPIRAN IV.A.10.9</option>
                <option value="51">LAMPIRAN IV.A.10.10</option>
                <option value="52">LAMPIRAN IV.A.11.5</option>
                <option value="53">LAMPIRAN IV.A.11.6</option>
                <option value="54">LAMPIRAN IV.A.11.7</option>
                <option value="55">LAMPIRAN IV.A.11.8</option>




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
