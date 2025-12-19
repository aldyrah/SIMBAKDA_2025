

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
    
    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <script type="text/javascript">
     $(document).ready(function() {
            $("#spasi").attr("value",0);
            $("#DIV_APBD").hide();
                        $("#div_bulan").hide();
                                            $("#div_periode").hide();
                                                $("#divperiode").hide();
                
            
        }); 
        
     $(function(){ 
      
            $('#skpd').combogrid({  
            panelWidth:700,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/rka/skpd',  
            columns:[[  
                {field:'kd_skpd',title:'Kode SKPD',width:100},  
                {field:'nm_skpd',title:'Nama SKPD',width:700}    
            ]],
            onSelect:function(rowIndex,rowData){
                nmskpd = rowData.nm_skpd;
                $("#nmskpd").attr("value",rowData.nm_skpd);
            }  
            });           
    
        
     
        
        $('#tgl2').datebox({  
            required:true,
            formatter :function(date){
                var y = date.getFullYear();
                var m = date.getMonth()+1;
                var d = date.getDate();
                return y+'-'+m+'-'+d;
            }
        });
      
      
       $('#tgl1').datebox({  
            required:true,
            formatter :function(date){
                var y = date.getFullYear();
                var m = date.getMonth()+1;
                var d = date.getDate();
                return y+'-'+m+'-'+d;
            }
        });  
        
        $('#tgl_ttd').datebox({  
            required:true,
            formatter :function(date){
                var y = date.getFullYear();
                var m = date.getMonth()+1;
                var d = date.getDate();
                return y+'-'+m+'-'+d;
            }
        });         
      
      
    
    
        $('#ttd').combogrid({  
            panelWidth:500,  
            url: '<?php echo base_url(); ?>/index.php/tukd/list_ttd',  
                idField:'nip',                    
                textField:'nama',
                mode:'remote',  
                fitColumns:true,  
                columns:[[  
                    {field:'nip',title:'NIP',width:60},  
                    {field:'nama',title:'NAMA',align:'left',width:100}                              
                ]],
                onSelect:function(rowIndex,rowData){
                nip = rowData.nip;
                
                }   
            });
            
               $('#bulan').combogrid({  
                   panelWidth:120,
                   panelHeight:300,  
                   idField:'bln',  
                   textField:'nm_bulan',  
                   mode:'remote',
                   url:'<?php echo base_url(); ?>index.php/rka/bulan',  
                   columns:[[ 
                       {field:'nm_bulan',title:'Nama Bulan',width:700}    
                   ]] 
               });      
      
       });
    
   
     function cetak()
    {    var apbd = document.getElementById('APBD').value;  
             ctglttd         = $('#tgl_ttd').datebox('getValue');
   var spasi       = document.getElementById('spasi').value;
       ckdskpd         = $('#skpd').combogrid('getValue');
       cbulan =  cbulan = $('#bulan').combogrid('getValue');
       ctgl1 = $('#tgl1').datebox('getValue');
       ctgl2 = $('#tgl2').datebox('getValue');

 
 
 
        if(ctk=='1'){
            var url    = "<?php echo site_url(); ?>/akuntansi/cetak_spj_skpd/1/";  
         lc = '?tgl1='+cbulan+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi+'&apbd='+apbd;
        }else if(ctk=='2'){
            
            
              if(ctk1==1){
           
            lc = '?kd_skpd='+ckdskpd+'&tgl1='+ctgl1+'&tgl2='+ctgl2+'&tgl_ttd='+ctglttd+'&spasi='+spasi+'&cpilih=1';
         }else{
           
            lc = '?kd_skpd='+ckdskpd+'&bulan='+cbulan+'&tgl_ttd='+ctglttd+'&spasi='+spasi+'&cpilih=2';
         }
            
            
            
            var url    = "<?php echo site_url(); ?>/akuntansi/cetak_bku_siadinda/1/";  
            
    
    }else if(ctk=='3'){
         var url    = "<?php echo site_url(); ?>/akuntansi/cetak_kas_tunai_siadinda/1/";  
         lc = '?tgl1='+cbulan+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi+'&apbd='+apbd;


    }else if(ctk=='4'){
         var url    = "<?php echo site_url(); ?>/akuntansi/cetak_pajak_siadinda/1/";  
              if(ctk1==1){
           
            lc = '?kd_skpd='+ckdskpd+'&tgl1='+ctgl1+'&tgl2='+ctgl2+'&tgl_ttd='+ctglttd+'&chal='+spasi+'&cpilih=1';
         }else{
           
            lc = '?kd_skpd='+ckdskpd+'&bulan='+cbulan+'&tgl_ttd='+ctglttd+'&chal='+spasi+'&cpilih=2';
         }
            

   }else if(ctk=='5'){
         var url    = "<?php echo site_url(); ?>/akuntansi/cetak_simpanan_bank/1/";  
         lc = '?tgl1='+cbulan+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi+'&apbd='+apbd;

        }
            window.open(url+lc, '_blank');
            window.focus();
    }
        
        
        
        
     function cetakex()
    {    var apbd = document.getElementById('APBD').value;  
             ctglttd         = $('#tgl_ttd').datebox('getValue');
   var spasi       = document.getElementById('spasi').value;
       ckdskpd         = $('#skpd').combogrid('getValue');
       cbulan =  cbulan = $('#bulan').combogrid('getValue');
       ctgl1 = $('#tgl1').datebox('getValue');
       ctgl2 = $('#tgl2').datebox('getValue');

 
 
 
        if(ctk=='1'){
            var url    = "<?php echo site_url(); ?>/akuntansi/cetak_spj_skpd/2/";  
         lc = '?tgl1='+cbulan+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi+'&apbd='+apbd;
        }else if(ctk=='2'){
            
            
              if(ctk1==1){
           
            lc = '?kd_skpd='+ckdskpd+'&tgl1='+ctgl1+'&tgl2='+ctgl2+'&tgl_ttd='+ctglttd+'&spasi='+spasi+'&cpilih=1';
         }else{
           
            lc = '?kd_skpd='+ckdskpd+'&bulan='+cbulan+'&tgl_ttd='+ctglttd+'&spasi='+spasi+'&cpilih=2';
         }
            
            
            
            var url    = "<?php echo site_url(); ?>/akuntansi/cetak_bku_siadinda/2/";  
            
    
    }else if(ctk=='3'){
         var url    = "<?php echo site_url(); ?>/akuntansi/cetak_kas_tunai_siadinda/2/";  
         lc = '?tgl1='+cbulan+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi+'&apbd='+apbd;


    }else if(ctk=='4'){
         var url    = "<?php echo site_url(); ?>/akuntansi/cetak_pajak_siadinda/2/";  
              if(ctk1==1){
           
            lc = '?kd_skpd='+ckdskpd+'&tgl1='+ctgl1+'&tgl2='+ctgl2+'&tgl_ttd='+ctglttd+'&chal='+spasi+'&cpilih=1';
         }else{
           
            lc = '?kd_skpd='+ckdskpd+'&bulan='+cbulan+'&tgl_ttd='+ctglttd+'&chal='+spasi+'&cpilih=2';
         }
            

            //cetak_simpanan_bank

    }else if(ctk=='5'){
         var url    = "<?php echo site_url(); ?>/akuntansi/cetak_simpanan_bank/2/";  
         lc = '?tgl1='+cbulan+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi+'&apbd='+apbd;


        }
            window.open(url+lc, '_blank');
            window.focus();
    }

        
     
       function opt(val){     
        ctk = val; 
        if (ctk=='1'){

            $("#DIV_APBD").show();
                    $("#div_periode").hide();
                    $("#div_bulan").show();          
        $("#divperiode").hide();
        } else if (ctk=='2'){
        
        
$("#divperiode").show();
            $("#DIV_APBD").hide();


    } else if (ctk=='3'){
        
          $("#DIV_APBD").hide();
                    $("#div_periode").hide();
                    $("#div_bulan").show();
                       $("#divperiode").hide();    


                       } else if (ctk=='4'){
        
        
        
$("#divperiode").show();
            $("#DIV_APBD").hide();
        } else if (ctk=='5'){
        
  $("#DIV_APBD").show();
                    $("#div_periode").hide();
                    $("#div_bulan").show();          
        $("#divperiode").hide();      $("#DIV_APBD").hide();
    
        }else {
            exit();
        } 
    }     

      function opt1(val1){        
        ctk1 = val1; 
        if (ctk1=='1'){
            $("#div_bulan").hide();
            $("#div_periode").show();
        } else if (ctk1=='2'){
            $("#div_bulan").show();
            $("#div_periode").hide();
            } else {
            exit();
        }                 
    }     
   </script>


<div id="content1" align="center"> 
    <h3 align="center"><b>CETAK SPJ SKPD</b></h3>
    
    
    
      <table align="center" style="width:100%;" border="0">  
      
      
         
      
            <tr>
                <td colspan="2" align="center" style="border-top:solid 1px red;border-bottom:solid 1px red"><i>LAPORAN DI SIADINDA</i></td>
            </tr>
            <tr>
                <td width="50%" />&nbsp;</td>
                <td width="50%" />&nbsp;</td>
            </tr>
            <tr>
                <td width="50%" align="left"><input type="radio" name="cetak" value="1" onclick="opt(this.value)"/>&nbsp;SPJ</td>
                <td width="50%" align="left">&nbsp;</td>
            </tr>
            
            <tr>
                <td width="50%" align="left"><input type="radio" name="cetak" value="2" onclick="opt(this.value)"/>&nbsp;BKU</td>
                <td width="50%" align="left">&nbsp;</td>
            </tr>

            <tr>
                <td width="50%" align="left"><input type="radio" name="cetak" value="3" onclick="opt(this.value)"/>&nbsp;KAS TUNAI</td>
                <td width="50%" align="left">&nbsp;</td>
            </tr>

                 <tr>
                <td width="50%" align="left"><input type="radio" name="cetak" value="4" onclick="opt(this.value)"/>&nbsp;BUKU PAJAK</td>
                <td width="50%" align="left">&nbsp;</td>
            </tr>
            
                             <tr>
                <td width="50%" align="left"><input type="radio" name="cetak" value="5" onclick="opt(this.value)"/>&nbsp;BUKU SIMAPANAN BANK</td>
                <td width="50%" align="left">&nbsp;</td>
            </tr>
            
     </table><br>
    
    
    
     <table align="center" style="width:100%;" border="0">
            
             <tr>
                 
                 
               <td align="center" colspan="3">
               <div id="divperiode">
               <table style="width:100%;" border="0">
               <tr>
                <td><input type="radio" name="cetak1" value="1" onclick="opt1(this.value)" />Periode &ensp;
                <input type="radio" name="cetak1" value="2" id="status" onclick="opt1(this.value)" />Bulan
                </td>
                <td>&ensp;</td>
                <td>&nbsp;</td>
            </tr></table>
           </div>
            
            </td>
            
            
            </td>
            
            <tr>
                <td colspan="3">
                <div id="div_skpd">
                        <table style="width:100%;" border="0">
                            <td width="20%">SKPD</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="skpd" name="skpd" style="width: 100px;" />&ensp;
                            <input type="text" id="nmskpd" readonly style="width: 400px;border:0" />
                            </td>
                        </table>
                </div>
                </td>
            </tr>                      
            <tr>
                <td colspan="3">
                <div id="div_bulan">
                        <table style="width:100%;" border="0">
                            <td width="20%">BULAN</td>
                            <td width="1%">:</td>
                            <td width="79%"><input type="text" id="bulan" style="width: 100px;" /> 
                            </td>
                        </table>
                </div>
                </td>
            </tr>
            
            
             <tr>
                <td colspan="3">
            
             <div id="div_periode">
                        <table style="width:100%;" border="0">
                            <td width="20%">PERIODE</td>
                            <td width="1%">:</td>
                            <td width="79%"><input type="text" id="tgl1" style="width: 100px;" /> s.d. <input type="text" id="tgl2" style="width: 100px;" />
                            </td>
                        </table>
                </div>
            
            </td></tr>
            
            
            
            <tr>
                <td colspan="3">
                <div id="div_bend">
                        <table style="width:100%;" border="0">
                            <td width="20%">TANGGAL TTD</td>
                            <td width="1%">:</td>
                            <td><input type="text" id="tgl_ttd" style="width: 100px;" /> 
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
             <tr>
                <td colspan="3">
                <div id="DIV_APBD">
                        <table style="width:100%;" border="0">
                            <td width="20%">JENIS APBD</td>
                            <td width="1%">:</td>
                            <td><select  name="APBD" id="APBD" >
               <option value="0">PENYUSUNAN</option>
               <option value="1" >PERUBAHAN</option> 
                          </select>
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
             <tr>
                <td colspan="3">
                <div>
                        <table style="width:100%;" border="0">
                            <td width="20%">ENTER TTD</td>
                            <td width="1%">:</td>
                            <td><input type="text" id="spasi" style="width: 50px;" /> 
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center">
               <p align="center">         
            <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a>   
            <a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetakex();">export</a>   
        </p> 
                </td>                
            </tr>
        </table>  
             
</div>  
