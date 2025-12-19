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
        var baseDocLocation = 'http://10.10.11.44/simbakda_2024/lam_semester2/8.A/';
        var docLocation;

        if (urut == 1) {
            docLocation = baseDocLocation + '8. ASET TAK BERWUJUD 0.4.8';
        } else if (urut == 2) {
            docLocation = baseDocLocation + '8. A LAMPIRAN ASET TAK BERWUJUD 0.4.8';
        } else {
            alert('cek pilihan cetakan');
            return;
        }

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
    <h1 align="center"><b>CETAK LAPORAN ASET TAK BERWUJUD</b></h1>
    <fieldset>
        <table align="center" style="width:100%;" border="0">
            <select id="itemsList" onchange="gettingList()">
                <option>SILAHKAN PILIH LAPORAN ASET TAK BERWUJUD</option>
                <option value="1">ASET TAK BERWUJUD 0.4.8</option>
                <option value="2">LAMPIRAN ASET TAK BERWUJUD 0.4.8</option>
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
            <tr><td colspan="3">&nbsp;</td></tr> 
            <tr><td colspan="3">&nbsp;</td></tr> 
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
