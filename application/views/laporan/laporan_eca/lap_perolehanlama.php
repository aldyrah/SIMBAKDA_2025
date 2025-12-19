<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
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



      function cetak(){

        gettingList()
        

        var urut =document.querySelector("#price").value
        if (urut == 111){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/111.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 


        }else if (urut==121){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/111.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==122){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/122.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==131){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/131.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==21){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/21.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==31){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/31.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==41){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/41.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==51){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/51.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==61){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/61.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==71){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/71.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==81){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/81.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==91){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/91.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else if (urut==101){
          var docLocation = 'http://localhost/MAPPI/simbakda_2023/files/a/101.pdf';
          window.open(docLocation,"resizeable,scrollbar"); 
        }else{
          alert('cek pilihan cetakan  ')
        }
      }


      function gettingList() {

        let itemsList = document.querySelector('#itemsList');
        let price = itemsList.value
        let item = itemsList.options[itemsList.selectedIndex].text

        document.querySelector("#price").value = price
        document.querySelector("#item").value = item

        console.log(price, item)
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
                 onSelect:function(rowIndex,rowData){
                                                  
                 }  
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
           onSelect:function(rowIndex,rowData){
                                            
           }  
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
           onSelect:function(rowIndex,rowData){
                                            
           }  
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
<input placeholder="Item" type="text" id="item" style="width:50%;" >
<tr>
              <td colspan="3">
                <div id="div_bulan">
                  <table style="width:100%;" border="0">
                    <td width="20%" >BULAN</td>
                    <td width="1%" >:</td>
                    <td width="79%" ><input  name="bulan" id="bulan" style="width: 150px;" >
                    </td>
                  </table>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <div id="div_tahun">
                  <table style="width:100%;" border="0">
                    <td width="20%" >TAHUN</td>
                    <td width="1%" >:</td>
                    <td width="79%" ><input  name="tahun" id="tahun" style="width: 150px;" >
                    </td>
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
                        <td><input type="text" id="tgl_cetak" style="width: 140px;" /></td>  
                    </table>
                </div>
                </td> 
                
            </tr>    
			
            </tr>
            <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
              <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
              <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
              <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
                <td colspan="3" align="center">
                <a  class="easyui-linkbutton" iconCls="icon-pdf" plain="false"  onclick="javascript:cetak(1);">Cetak Pdf</a>
                <a  class="easyui-linkbutton" iconCls="icon-excel" plain="false" onclick="javascript:cetak(2);">Cetak Excel</a>
                <a  class="easyui-linkbutton" iconCls="icon-word" plain="false" onclick="javascript:cetak(3);">Cetak Word</a>
                <a  class="easyui-linkbutton" iconCls="icon-note_book" plain="false" onclick="javascript:cetak(4);">Cetak HTML</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="false">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>