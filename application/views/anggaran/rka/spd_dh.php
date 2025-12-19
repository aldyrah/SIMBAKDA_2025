<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script> 
 <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery.maskMoney.min.js"></script>

    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <script type="text/javascript">
    
    var kode  = '';
    var jenis = '';
    var ket = '';
    var nomor = '';
    var nomor2 = '';
    var nipx='';
    var status='';
    var statusx='';
    var cek   =1;
    var cid   = 0;
    var ctk   = ''; 
    var lcstatus='';
    var pass=''; 
	var nm_sdana=''; 
	var no_sdana ='';                  
    
    $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 620,
                width: 800,
                modal: true,
                autoOpen:false                
            });
             $( "#dialog-cetak" ).dialog({
                height: 200,
                width: 300,
                modal: true,
                autoOpen:false                
            });
             $( "#dialog-pass" ).dialog({
                height: 200,
                width: 400,
                modal: true,
                autoOpen:false                
            });
            
        }); 
    $(document).ready(function(){
      $('#nilai').maskMoney({thousands:',', decimal:'.', precision:0});
    });   
     
     $(function(){ 
     $('#dg').edatagrid({
    url: '<?php echo base_url(); ?>/index.php/rka/load_spd',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
     rowStyler: function(index,row){
    if (row.setuju>0){
      return 'background-color:skyblue;';
    }
  },
        pagination:"true",
        nowrap:"true",                       
        columns:[[
          {field:'no_spd',
        title:'Nomor SPD',
        width:50},
            {field:'tgl_spd',
        title:'Tanggal',
        width:30},
            {field:'nm_skpd',
        title:'Nama SKPD',
        width:100,
            align:"left"},
            {field:'total1',
        title:'Jumlah SPD',
        width:50,
            align:"right"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor = rowData.no_spd;
          nomor2=rowData.no_spd;
          tgl   = rowData.tgl_spd;
          kode  = rowData.kd_skpd;
          nama  = rowData.nm_skpd;
          bulan1= rowData.bulan_awal;
          bulan2= rowData.bulan_akhir;
          jns   = rowData.jns_beban; 
          ket   = rowData.ketentuan; 
          nm_bnd= rowData.nm_bend; 
          sdana   = rowData.sdana;
      	  nolpj   = rowData.nolpj;
      	  jeniss   = rowData.jeniss;      
          tot   = number_format(rowData.total,2,'.',',');
          get(nomor,tgl,kode,nama,bulan1,bulan2,jns,tot,ket,sdana,nomor2,nm_bnd,nolpj,jeniss);  
          load_detail();  
          cek=0;
          lcstatus='edit';
          cek_spp(nomor);
        },
        onDblClickRow:function(rowIndex,rowData){  
          $('#nomor').attr('disabled',true);
          $('#skpd').combogrid('disable');
         // $("#tanggal").datebox("disable");
          //$('#sdana').combogrid('disable');
         // $('#jenis').attr('disabled',true);
		  //$('#jeniss').attr('disabled',true);
		 // $('#bulan1').attr('disabled',true);
		  //$('#bulan2').attr('disabled',true);
		  $('#nlpj').combogrid('disable');
		  $('#nilai').attr('disabled',false);
          cek=0;
          section2();
       }
    });
    
        $('#tanggal').datebox({  
            required:true,
            formatter :function(date){
              var y = date.getFullYear();
              var m = date.getMonth()+1;
              var d = date.getDate();
              return y+'-'+m+'-'+d;
            }
        });
		
		/*$("#sdana").combogrid({
                panelWidth:700,
                idField   :'nm_sdana',
                textField :'nm_sdana',
                mode      :'remote',
                url       : '<?php echo base_url(); ?>index.php/rka/ambil_sdana_ms_ubah',
                columns   : [[
                {field:'kd_sdana',title:'Kode',width:100},
                {field:'nm_sdana',title:'Sumber Dana',width:600}
                ]],
				onClickRow:function(rowIndex, rowData){
                nm_sdana = rowData.nm_sdana;
                $("#sdana").combogrid("setValue",nm_sdana);
				}
            });*/

   
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
               kode = rowData.kd_skpd; 
         
               
               $("#nmskpd").attr("value",rowData.nm_skpd);
               $('#giat').combogrid({url:'<?php echo base_url(); ?>index.php/rka/load_trskpd',
                                     queryParams:({kode:kode})
                                     });
               $('#bendahara').combogrid({url:'<?php echo base_url(); ?>index.php/rka/pilih_bend',
                                     queryParams:({kode:kode})
                                     });
        
             $('#jeniss').attr('value','');
      $('#giat').attr('value','');       
       $('#nlpj').combogrid('clear');
       jbeban();
       
           }  
         });
     
     
  	$('#nlpj').combogrid({
    
           panelWidth:350,  
           idField:'no_lpj',  
           textField:'no_lpj',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/rka/pilih_nlpj',  
           columns:[[  
               {field:'no_lpj',title:'NO LPJ',width:240},
         {field:'nilai',title:'NILAI', align:'right',width:100}
  
           ]],  
           onSelect:function(rowIndex,rowData){
        kode = rowData.kd_skpd;
        nilai = rowData.nilai;
        var bln_akhir= document.getElementById('bulan2').value;

          $('#nillpj').attr('value',rowData.nilai2);
          validate_giat();
           validate_cek();
              
           }  
         });

    
    $('#sdana').combogrid({  
           panelWidth:500,  
           idField   :'nm_sdana',  
           textField :'nm_sdana',  
           mode      :'remote',
           columns   :[[  
               {field:'nm_sdana',title:'Sumber Dana',align:'left',width:500}           
         	]],
			onSelect:function(rowIndex,rowData){
				sdana = rowData.nm_sdana;
				no_sdana = rowData.no_sdana;
			}    
     });

     $('#bendahara').combogrid({  
           panelWidth:700,  
           idField   :'nama',  
           textField :'nama',  
           mode      :'remote',
           columns   :[[  
               {field:'nip',title:'NIP',width:150},  
               {field:'nama',title:'NAMA',align:'left',width:250},
				{field:'jabatan',title:'JABATAN',align:'left',width:300},           
         ]],
        onSelect:function(rowIndex,rowData){
        nipx = rowData.nip;
         }    
      });
        
        
        $('#dg1').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true",            
            singleSelect:"true",
            autoRowHeight:"false",
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    nilx = rowData.nilai;
            },                                                     
            columns:[[                
              {field:'no_spd',
                title:'Nomor SPD',        
                hidden:"true"},                
              {field:'nilai',
                title:'Nilai Rupiah',
                width:180,
                align:"right"},
              {field:'lalu',
                title:'Telah Di SPD kan',
                width:180,
                align:"right"},
                {field:'anggaran',
            title:'anggaran',
                width:180,
                align:"right"},
            {field:'anggaran_ubah',
                title:'anggaran_ubah',
                width:180,
                align:"right"}
                             
            ]]
        }); 
        
        
        $('#dg2').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true",             
            singleSelect:"true",
            autoRowHeight:"false",
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    nilx = rowData.nilai;
            },                                                     
            columns:[[  
                {field:'hapus',
            title:'Hapus',
                width:50,
                align:"center",
                formatter:function(value,rec){                                                                       
                    return '<img src="<?php echo base_url(); ?>/assets/images/icon/cross.png" onclick="javascript:hapus_detail();" />';                  
                    }                
                },          
            {field:'no_spd',
                title:'Nomor SPD',        
                hidden:"true"},                
            {field:'nilai',
                title:'Nilai Rupiah',
                width:150,
                align:"right"},
            {field:'lalu',
                title:'Telah Di SPD kan',
                width:150,
                align:"right"},
            {field:'anggaran',
                title:'anggaran',
                width:150,
                align:"right"},
            {field:'anggaran_ubah',
                title:'anggaran_ubah',
                width:150,
                align:"right"}                       
            ]]
        });      
    });

	function validate_giat(){ 
		var skpd = $('#skpd').combogrid('getValue');
		var jenis = document.getElementById('jenis').value;
		var no = document.getElementById('nomor').value;
		var sdana = $('#sdana').combogrid('getValue');
		var bln_akhir= document.getElementById('bulan2').value;
		var nil_lpj = document.getElementById('nillpj').value;
     
         $.ajax({
            type: 'POST',
            data:({kode:skpd,jenis:jenis,no:nomor,sumber:sdana}),
            url:"<?php echo base_url(); ?>index.php/rka/load_trskpd",
            dataType:"json",
            success:function(data){    
                $.each(data, function(i,n){
                $('#anggaran').attr("value",number_format(n['total'],2,'.',',')); 
                $('#anggaran_ubah').attr("value",number_format(n['total_ubah'],2,'.',','));  
        
        //$('#tw1').attr("value",number_format(n['tw1'],2,'.',','));
        //$('#tw2').attr("value",number_format(n['tw2'],2,'.',','));
        //$('#tw3').attr("value",number_format(n['tw3'],2,'.',','));
        //$('#tw4').attr("value",number_format(n['tw4'],2,'.',','));      
        
                document.getElementById('nilai').focus();
              });
               spdlalu();
            }
         });
  } 

        
  function validate_cek(){ 
    var skpd = $('#skpd').combogrid('getValue');
    var jenis = document.getElementById('jenis').value;
    var no = document.getElementById('nomor').value;
    var sdana = $('#sdana').combogrid('getValue');
    var bln_akhir= document.getElementById('bulan2').value;
    var nil_lpj = document.getElementById('nillpj').value;
     
         $.ajax({
            type: 'POST',
            data:({kode:skpd,jenis:jenis,no:nomor,sumber:sdana}),
            url:"<?php echo base_url(); ?>index.php/rka/load_trskpd",
            dataType:"json",
            success:function(data){    
                $.each(data, function(i,n){
                $('#anggaran').attr("value",number_format(n['total'],2,'.',',')); 
                $('#anggaran_ubah').attr("value",number_format(n['total_ubah'],2,'.',','));  
        
        //$('#tw1').attr("value",number_format(n['tw1'],2,'.',','));
        //$('#tw2').attr("value",number_format(n['tw2'],2,'.',','));
        //$('#tw3').attr("value",number_format(n['tw3'],2,'.',','));
        //$('#tw4').attr("value",number_format(n['tw4'],2,'.',',')); 
    
        //var t1 = angka(document.getElementById('tw1').value);
        //var t2 = angka(document.getElementById('tw2').value);
        //var t3 = angka(document.getElementById('tw3').value);
        //var t4 = angka(document.getElementById('tw4').value);
        
        //var ts1 = t1+t2;
        //var ts2 = t1+t2+t3;
        //var ts3 = t1+t2+t3+t4;
        var nilpj = number_format(nil_lpj,2,'.',',');
    /*if (bln_akhir<='3'){
		  if(t1<nilpj){
			// alert('t1'+t1);
			// alert('nil_lpj'+nil_lpj);
			swal({
			  title:"<a style='font-size:large;'>Nilai SPD Melebihi Pagu Anggaran Triwulan 1 </a> " ,
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "red",
			  html:true,
			  type: "error",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
			//$('#tambahdetail').linkbutton('disable');
		  }else{
			exit();
		  }
    }else if (bln_akhir<='6'){
		  if(ts1<nilpj){
			swal({
			  title:"<a style='font-size:large;'>Nilai SPD Melebihi Pagu Anggaran Triwulan 2 </a> " ,
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "red",
			  html:true,
			  type: "error",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
			//$('#tambahdetail').linkbutton('disable');
		  }else{
			exit();
		  }
    }else if (bln_akhir<='9'){
			  if(ts1<nilpj){
				swal({
				  title:"<a style='font-size:large;'>Nilai SPD Melebihi Pagu Anggaran Triwulan 3 </a> " ,
				  text: "Akan Menutup Dalam 2 Detik!!!",
				  confirmButtonColor: "red",
				  html:true,
				  type: "error",
				  timer: 3500,
				  confirmButtonText: "Ya",
				  showConfirmButton: true
				});
				$('#tambahdetail').linkbutton('disable');
			  }else{
				exit();
			  }
    	}else{
			  if(ts1<nilpj){
				swal({
				  title:"<a style='font-size:large;'>Nilai SPD Melebihi Pagu Anggaran Triwulan 4 </a> " ,
				  text: "Akan Menutup Dalam 2 Detik!!!",
				  confirmButtonColor: "red",
				  html:true,
				  type: "error",
				  timer: 3500,
				  confirmButtonText: "Ya",
				  showConfirmButton: true
				});
				//$('#tambahdetail').linkbutton('disable');
			  }else{
				exit();
			  }
    	}*/
        
                document.getElementById('nilai').focus();
              });
               spdlalu();
            }
        });
	}     
    
    function cek_spp(w){
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/rka/cek_spp',
                data: ({ckim:w}),
                dataType:"json",
                success:function(data){   
          message=data.pesan;
          if(message == '0'){
             $('#save').linkbutton('enable');
             $('#hapus').linkbutton('enable');
             $('#save_keg').linkbutton('enable');
             document.getElementById("p1").innerHTML="";
          }else{
             $('#save').linkbutton('disable');
             $('#hapus').linkbutton('disable');
             $('#save_keg').linkbutton('disable');
             document.getElementById("p1").innerHTML="Sudah di Buat SPP!!";
          }
                }
            });
           });        
  
  }
    function beban(){
         jenis = document.getElementById('jenis').value; 
         $('#giat').combogrid({
               url:'<?php echo base_url(); ?>index.php/rka/load_trskpd',
               queryParams:({kode:kode,jenis:jenis})
         });
         sumber_dana();
     if(jenis=='52'){
       $('#jeniss').attr('disabled',false); 
       $('#nlpj').combogrid('disable');
       jbeban();
     }else{
       $('#jeniss').attr('disabled',false); 
       $('#nlpj').combogrid('disable');
       $('#jeniss').attr('value',''); 
       $('#nlpj').combogrid('clear');
     }
    }
  
  function jbeban(){
		var jeniss1 = document.getElementById('jeniss').value;
		var kode1=$('#skpd').combogrid('getValue');
		jenis = document.getElementById('jenis').value; 
		sumber_dana();
		  if((jeniss1=='1' || jeniss1=='2' || jeniss1=='4')&& jenis=='52'){
			  $('#nlpj').combogrid({url:'<?php echo base_url(); ?>index.php/rka/pilih_nlpj',
											 queryParams:({kode:kode1,jeniss:jeniss1,jenis:jenis})
											 });
			  $('#nlpj').combogrid('enable');
		 }else{
		   $('#nlpj').combogrid('disable'); 
		   $('#nlpj').combogrid('clear');
		   $('#nillpj').attr('value',''); 
		 }
    }
  
  
  

    function sumber_dana(){
      var jenis = document.getElementById('jenis').value;
      $('#sdana').combogrid({  
          url: '<?php echo base_url(); ?>/index.php/rka/ambil_sdana_dh',  
          queryParams:({kode:kode,jenis:jenis})   
        });
    }
    
    
    function filter_giat(){
        var vskpd = '';
        $('#dg1').edatagrid('selectAll');
        var rows = $('#dg1').edatagrid('getSelections');                   
    for(var i=0;i<rows.length;i++){
      fskpd = "'"+rows[i].kd_skpd+"'";
            if (i>0){
                vskpd = vskpd +","+fskpd;
            }else{
                vskpd=fskpd;
            }
            
        }   
        var cno = document.getElementById('nomor').value;
        var sumber = ('#sdana').combogrid('getValue');                            
        $('#dg1').edatagrid('unselectAll');   
        $('#giat').combogrid({  
             url:'<?php echo base_url(); ?>index.php/rka/load_trskpd',
             queryParams:({kode:kode,jenis:jenis,no:cno,sumber:sumber})
        });
    }
    
  function load_detail(){
    var skpd = $('#skpd').combogrid('getValue');
    var jenis = document.getElementById('jenis').value;
    var sdana = $('#sdana').combogrid('getValue');
    var kk = document.getElementById('nomor').value;
       
      $('#dg1').edatagrid({
            toolbar:"#toolbar",              
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
      showFooter:true,
      nowrap:false,
      url: '<?php echo base_url(); ?>/index.php/rka/load_dspd_ar',
            queryParams:({ no:kk,skpd:skpd,jenis:jenis,sdana:sdana })
    });
        beban();
        jumlah_detail();
        $('#dg1').edatagrid('reload');
    }
    
  function jumlah_detail()
        {
            var kk = document.getElementById("nomor").value;
          $.ajax({
            url:'<?php echo base_url(); ?>index.php/rka/jumlah_detail_spd',
            type: "POST",
            dataType:"json",   
                data: ({cno_spd:kk}),                      
            success:function(data){
          $("#total").attr("value",number_format(data.total,0,'.',','));
          }                                     
          });
        } 
    
  function load_detail_kosong(){
    var no_kos = '' ;
      $('#dg1').edatagrid({
      url: '<?php echo base_url(); ?>/index.php/rka/load_dspd',
            queryParams:({ no:no_kos }),
          columns:[[                
              {field:'no_spd',
                title:'Nomor SPD',        
                hidden:"true"},                
              {field:'nilai',
                title:'Nilai Rupiah',
                width:180,
                align:"right"},
            {field:'lalu',
                title:'Telah Di SPD kan',
                width:180,
                align:"right"},
            {field:'anggaran',
                title:'anggaran',
                width:180,
                align:"right"},
            {field:'anggaran_ubah',
                title:'anggaran_ubah',
                width:180,
                align:"right"}               
            ]]
        });
    }
    

    function load_detail2(){        
       $('#dg1').edatagrid('selectAll');
       var rows = $('#dg1').edatagrid('getSelections');             
      for(var p=0;p<rows.length;p++){
       no = rows[p].no_spd;                                                                    
           nil = rows[p].nilai;
           lal = rows[p].lalu;
           ang = rows[p].anggaran;
           ang_ubh = rows[p].anggaran_ubah;                                                                                                                                                                                                                                                                         
           $('#dg2').edatagrid('appendRow',{no_spd:no,nilai:nil,lalu:lal,anggaran:ang,anggaran_ubah:ang_ubh});            
        }
        $('#dg1').edatagrid('unselectAll');
    } 
   
   function section1(){
         $(document).ready(function(){    
             $('#section1').click();    
             $('#dg').edatagrid('reload');                                           
         });         

     }
     
     function section2(){
         $(document).ready(function(){                
             $('#section2').click();
             document.getElementById("nomor").focus(); 
         });     
     }
       
     
    function get(nomor,tgl,kode,nama,bulan1,bulan2,jns,tot,ket,sdana,nomor2,nm_bend,nolpj,jeniss){
        $("#nomor").attr("value",nomor);
        $("#nomor2").attr("value",nomor2);
        $("#tanggal").datebox("setValue",tgl);
        $("#skpd").combogrid("setValue",kode);
        $("#nmskpd").attr("value",nama);
        $("#bulan1").attr("value",bulan1);
        $("#bulan2").attr("value",bulan2);
        $("#jenis").attr("value",jns);
        $("#ketentuan").attr("value",ket);
        $("#bendahara").combogrid("setValue",nm_bend);
    	$("#jeniss").attr("disabled",true);
    	$("#nlpj").combogrid("disable");
        if(nm_bend == null || nm_bend == ''){
        $("#bendahara").combogrid("clear");
        }
        $("#sdana").combogrid("setValue",sdana);
        $("#total").attr("value",tot); 
        $("#pass").attr("value",'');
        $("#usr").attr("value",'');
    
    	$("#nlpj").combogrid("setValue",nolpj);
    	$("#jeniss").attr("value",jeniss);  
            
    }
	
	function oto(){	
		$.ajax({
        		url: '<?php echo base_url(); ?>index.php/rka/load_oto_spdls',
				type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#nomor").attr("value",data.u);
        							  }                                     
       	});    
    }
    
    function kosong(){
        cdate = '<?php echo date("Y-m-d"); ?>'; 
		asu = oto();       
        $("#nomor").attr("value",asu);
        $("#nomor").attr("disabled",false);
        $("#nomor2").attr("value",'');
        $("#tanggal").datebox("setValue",cdate);
        $("#tanggal").datebox("enable");
        $("#skpd").combogrid("enable");
        $("#skpd").combogrid("clear");
    	$("#skpd").combogrid("grid").datagrid('reload');
        $("#nmskpd").attr("value",'');
        $("#bulan1").attr("value",'');
        $("#bulan2").attr("value",'');
        $("#jenis").attr("value",'');
        $("#bendahara").combogrid("clear");
        $("#ketentuan").attr("value",'UP/GU/TU/LS');
        $("#sdana").combogrid("clear");
        $("#sdana").combogrid("enable");
        $("#pass").attr("value",'');
        $("#usr").attr("value",'');
        $('#jenis').attr('disabled',false);
    	$('#bulan1').attr('disabled',false);
    	$('#bulan2').attr('disabled',false);
        var kode = '';
        var nomor = '';
        cek=1;
        $("#nilai").attr("disabled",false);
        $('#nilai').attr('value','0');
        $('#sisa').attr('value','0');
        $('#total').attr('value','0');
        document.getElementById("p1").innerHTML="";
        $('#save').linkbutton('enable');
        $('#hapus').linkbutton('enable');
        $('#save_keg').linkbutton('enable');
        document.getElementById("p1").innerHTML="";
        load_detail_kosong();
        document.getElementById("nomor").focus();
        lcstatus='tambah';  
		$('#jeniss').attr('disabled',true);
		$('#jeniss').attr('value','');
		$('#nillpj').attr('value','');
		$('#nlpj').combogrid('clear');
		$('#nlpj').combogrid('disable');
		$('#nilai').attr('disabled',false);   
    }
    
    function kosong2(){
    
	   var ang = angka(document.getElementById('anggaran_ubah').value);
	   var lalu = angka(document.getElementById('lalu').value);
	   var jnss = document.getElementById('jeniss').value;
	   var nlp = angka(document.getElementById('nillpj').value);
	   var nlp2 = document.getElementById('nillpj').value;
	   var nlpj = $('#nlpj').combogrid('getValue');
	   
		  $('#skpd').combogrid('disable'),true;
		  $('#sdana').combogrid('disable'),true;
		  sisa=ang-lalu-nlp;
		if(jnss=='1'){
		  $('#nilai').attr('value',nlp2);		  
		  $('#selisih').attr('value',number_format(sisa,0,'.',','));
			  if(nlpj==''){
			  $('#nilai').attr('disabled',false);
			  }else{
			  $('#nilai').attr('disabled',true);
			  }		  
		}else{
		 $('#nilai').attr('value','0');
		 $('#selisih').attr('value','0');
		 $('#nilai').attr('disabled',false);
		}
    
      
    }
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
      $(function(){ 
        $('#dg').edatagrid({
        url: '<?php echo base_url(); ?>/index.php/rka/load_spd',
        queryParams:({cari:kriteria})
        });        
     });
    }
    function append_save(){        
        var nomor   = document.getElementById('nomor').value;
    
    a=document.getElementById('nilai').value;
        var nil     = angka(document.getElementById('nilai').value);
        var ang     = angka(document.getElementById('anggaran').value);
        var ang_ubh = angka(document.getElementById('anggaran_ubah').value);
        var lal     = angka(document.getElementById('lalu').value);
        var tot1    = angka(document.getElementById('total').value);
       // var sumber  = document.getElementById('sdana').value;        
      var sumber  = '';         
        var tot2    = 0; 
        
        sisa_spd();
 if ( a == ''|| a==0 ){
       swal({
    title: 'nilai tidak boleh nol...!!!',    text: "Auto close alert 2 second",  type: "warning",  timer: 1000, showConfirmButton: false }); 
          
            exit();
        }
                          
        if (nil != 0 && ang_ubh != 0) {                                              
            tot2 = tot1 + nil;
            nil = number_format(nil,2,'.',',');
            lal = number_format(lal,2,'.',',');
            ang = number_format(ang,2,'.',',');
            ang_ubh = number_format(ang_ubh,2,'.',',');
            $('#dg1').datagrid('appendRow',{no_spd:nomor,sumber:sumber,nilai:nil,anggaran:ang,anggaran_ubah:ang_ubh,lalu:lal});
            $('#dg2').datagrid('appendRow',{no_spd:nomor,sumber:sumber,nilai:nil,anggaran:ang,anggaran_ubah:ang_ubh,lalu:lal});              
            $('#total').attr('value',number_format(tot2,2,'.',','));                          
            $('#total1').attr('value',number_format(tot2,2,'.',',')); 
            $('#nilai').attr('disabled',true);
            $('#jenis').attr('disabled',true);
      		$('#jeniss').attr('disabled',true);
            $('#nlpj').combogrid('disable');      
            filter_giat();
            kosong2(); 
        } 
                                
    }     
    
    function cetak(){
        var nomor = document.getElementById('nomor').value;
        $("#dialog-cetak").dialog('open');
        $('#nomor1').attr('value',nomor);
        $('#jnsrek').attr('value',jns);
    }                 
    
    function opt(val){        
        ctk   = val; 
        if (ctk=='2'){
            urll ='<?php echo base_url(); ?>index.php/rka/cetak_lampiran_spd1';
        } else if (ctk=='1'){
            urll ='<?php echo base_url(); ?>index.php/rka/cetak_otor_spd';
        } else {
            exit();
        }          
        $('#frm_ctk').attr('action',urll);                        
    }      
     
    function submit(){
        urll ='<?php echo base_url(); ?>index.php/rka/cetak_otor_spd';
        $('#frm_ctk').attr('action',urll);
        document.getElementById("frm_ctk").submit();    
    }
    

    function tambah(){
        $('#dg1').edatagrid('selectAll');
        var rows = $('#dg1').edatagrid('getSelections');
        for(var p=0;p<rows.length;p++){
          no = rows[p].no_spd;                                                                    
           if(no>0){
            alert('Tidak Boleh Lebih Dari 1 Detail');
            exit();            
           }           
        }
        var cno = document.getElementById('nomor').value;
        var kd = $('#skpd').combogrid('getValue');
    	var nlpjj = $('#nlpj').combogrid('getValue');
        var tgl = $('#tanggal').datebox('getValue');
        var bln_awal= document.getElementById('bulan1').value;
        var bln_akhir= document.getElementById('bulan2').value;
        var jns=document.getElementById('jenis').value;
    	var jnss=document.getElementById('jeniss').value;
        var total = document.getElementById('total').value;
        var b1 =angka(bln_awal);
        var b2 =angka(bln_akhir);
        var sumber = $('#sdana').combogrid('getValue');
        var bend = $('#bendahara').combogrid('getValue');    
    
          if(cno==''){
              swal({
                title:"<a style='font-size:large;'>Nomor SPD Tidak Boleh kosong!! </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "warning",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
              });
              exit();
          }
              if(bln_awal==0 || bln_awal=='' )
              { 
              swal({
                title:"<a style='font-size:large;'>Pilihan Bulan Awal Tidak Boleh Kosong </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "warning",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
              });
              exit();
              }
              if(bln_akhir==0 || bln_akhir==''){
              swal({
                title:"<a style='font-size:large;'>Pilihan Bulan Akhir Tidak Boleh Kosong </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "warning",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
              });
                exit();
              }
              if(jns==0 || jns==''){
              swal({
                title:"<a style='font-size:large;'>Jenis Beban Tidak Boleh Kosong!!! </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "warning",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
              });
              exit();
              }
            if(jnss==0 || jnss==''){
              swal({
                title:"<a style='font-size:large;'>Jenis SPP Tidak Boleh Kosong!!! </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "warning",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
              });
              exit();
              }
			if(jnss==1){
				if(nlpjj==0 || nlpjj==''){
				  /*swal({
					title:"<a style='font-size:large;'>Nomor LPJ Tidak Boleh Kosong 1!!! </a> " ,
					text: "Akan Menutup Dalam 2 Detik!!!",
					confirmButtonColor: "red",
					html:true,
					type: "warning",
					timer: 3500,
					confirmButtonText: "Ya",
					showConfirmButton: true
				  }); 
				  exit();*/
				}
				else{
                  var urll1= '<?php echo base_url(); ?>/index.php/rka/amanan_gu';
                  $(document).ready(function(){
                  $.post(urll1,({skpd:kd,lpj:nlpjj}),
                  function(data){
                      status = data; 
						if(status=='777'){
							exit();
						}
						else{
							swal({
							  title:"<a style='font-size:large;'>MAAF!! Nomor LPJ Tidak Terdaftar!!! </a> " ,
							  text: "Akan Menutup Dalam 2 Detik!!!",
							  confirmButtonColor: "red",
							  html:true,
							  type: "warning",
							  timer: 3500,
							  confirmButtonText: "Ya",
							  showConfirmButton: true
							});
							$("#dialog-modal").dialog('close');
							exit();
						}
                    });
                  });
				}
			}
        
			if(jnss==2){
				var urll1= '<?php echo base_url(); ?>/index.php/rka/amanan_tu';
				$(document).ready(function(){
				$.post(urll1,({skpd:kd,lpj:nlpjj}),
					function(data){
					status = data; 
							  
					if((nlpjj==0 || nlpjj=='')&&status=='777'){
					  
					  exit();
					  
					}
						else if(nlpjj==0 || nlpjj==''){
						  
						  swal({
							title:"<a style='font-size:large;'>Nomor LPJ Tidak Boleh Kosong 2!!! </a> " ,
							text: "Akan Menutup Dalam 2 Detik!!!",
							confirmButtonColor: "red",
							html:true,
							type: "warning",
							timer: 3500,
							confirmButtonText: "Ya",
							showConfirmButton: true
						  });
						  $("#dialog-modal").dialog('close');
						  exit();
						  
						  
						}else{
								  if(status=='777'){
									exit();
								  }
								  else{
									swal({
									  title:"<a style='font-size:large;'>MAAF!! Nomor LPJ Tidak Terdaftar!!! </a> " ,
									  text: "Akan Menutup Dalam 2 Detik!!!",
									  confirmButtonColor: "red",
									  html:true,
									  type: "warning",
									  timer: 3500,
									  confirmButtonText: "Ya",
									  showConfirmButton: true
									});
									$("#dialog-modal").dialog('close');
									exit();
								  }
								
							  
						}
					});
				});
			}
            
            
              if(b2<b1 ){
              swal({
                title:"<a style='font-size:large;'>Bulan Akhir Tidak Boleh Kecil Dari Bulan Awal!!! </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "warning",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
              });
               
                exit();
              }
              if(bend==''){
              swal({
                title:"<a style='font-size:large;'>Nama Bendahara Tidak Boleh kosong!! </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "warning",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
              });
              exit();
              }
              if(sumber=='' && kd!='1.20.05.01' && jns=='62'){
              swal({
                title:"<a style='font-size:large;'>Sumber Dana Tidak Boleh kosong!! </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "warning",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
              });
                 exit();
              }
              if(lcstatus=='tambah'){
              cek_no();
              }

              $('#dg2').edatagrid('reload');
              if (kd != '' && tgl != ''){ 
                validate_giat();
                kosong2();
                $("#dialog-modal").dialog('open');
                $('#total1').attr('value',total);
                load_detail2();
              } else {
              swal({
                title:"<a style='font-size:large;'>Harap Isi Kode SKPD dan Tanggal SPD </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "error",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
              });
                     
              }
    
    
          
        
          
    
    
       
        
    }
    
    function keluar(){
        $("#dialog-modal").dialog('close');
        $("#dialog-cetak").dialog('close');
        $("#dialog-pass").dialog('close');
        $('#jenis').attr('disabled',true);
        $("#nilai").attr("disabled",false);
       kosong2();
    }    
    
    function hapus_giat(){
         tot3 = 0;
         $("#sdana").combogrid("enable");
         $('#jenis').attr('disabled',false);
         var tot = angka(document.getElementById('total').value);
         tot3 = tot - nilx;
         $('#total').attr('value',number_format(tot3),2,'.',',');        
         $('#dg1').datagrid('deleteRow',idx); 

    }
    
    function hapus_detail(){
        var rows = $('#dg2').edatagrid('getSelected');
        cgiat = rows.no_spd;        
        cnil = rows.nilai;
        var idx = $('#dg2').edatagrid('getRowIndex',rows);
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor : '+cgiat+' ,Nilai : '+cnil);
        if (tny==true){
            $('#dg2').edatagrid('deleteRow',idx);
            $('#dg1').edatagrid('deleteRow',idx);
            total = angka(document.getElementById('total1').value) - angka(cnil);            
            $('#total1').attr('value',number_format(total,2,'.',','));    
            $('#total').attr('value',number_format(total,2,'.',','));
            $('#nilai').attr('disabled',false);
            kosong2();
        } 
        
    }
    //Demansyah 24 Januari 2016
    function passwd(){
      var cnomor = document.getElementById('nomor').value;
      var jns = document.getElementById('jenis').value;
      $("#dialog-pass").dialog('open');
      $('#nomor18').attr('value',cnomor);
      $('#jnsrek18').attr('value',jns);
    }

    function cek_usr_pass(){
      var usr = document.getElementById('usr').value;
      var pswd= document.getElementById('pass').value;

      if(usr!='berotabui'){
        swal({
          title:"<a style='font-size:large;'>Username dan Password Salah! </a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "red",
          html:true,
          type: "error",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        }); 
    
        $('#usr').attr('value','');
        $('#pass').attr('value','');
        exit();
      }
      
      $.ajax({
      type:'post',
      data:({usr:usr,pswd:pswd}),
      url :"<?php echo base_url(); ?>/index.php/rka/cekuser",
      dataType:"json",
      success:function(data){

        $.each(data,function(i,n){
              var ssx =n['jumlah_user'];
              
              if(ssx==1){
                hapus();
              }else{
                swal({
          title:"<a style='font-size:large;'>Username dan Password Salah! </a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "red",
          html:true,
          type: "error",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        }); 
                $('#usr').attr('value','');
                $('#pass').attr('value','');
                exit();
              }
            });
         }
      });
    }


    function hapus(){
        $("#dialog-pass").dialog('close');
        var stj = document.getElementById('usr').value;
        var cnomor = document.getElementById('nomor').value;
        var urll = '<?php echo base_url(); ?>index.php/rka/hapus_spd';
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor SPD : '+cnomor);
        if (tny==true){
        $(document).ready(function(){
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({no:cnomor,stj:stj}),
                 success:function(data){
                        status = data.pesan;
                        if (status=='1'){
                            swal({
          title:"<a style='font-size:large;'>Data Berhasil Dihapus....! </a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "#80C8FE",
          html:true,
          type: "succes",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        });   
                            $('#dg').edatagrid('reload'); 
                            section1();     
                        } else {
              swal({
                title:"<a style='font-size:large;'>Gagal Hapus...! </a> " ,
                text: "Akan Menutup Dalam 2 Detik!!!",
                confirmButtonColor: "red",
                html:true,
                type: "error",
                timer: 3500,
                confirmButtonText: "Ya",
                showConfirmButton: true
                });
                            
                        }        
                    }
                });           
            });
        }   
    }
    
    
    function simpan_spd(){
        var cno = document.getElementById('nomor').value;
        var ctgl = $('#tanggal').datebox('getValue');
        var cskpd = $('#skpd').combogrid('getValue');
        var cnmskpd = document.getElementById('nmskpd').value;
        var cbend = $('#bendahara').combogrid('getValue');
        var cbln1 = angka(document.getElementById('bulan1').value);
        var cbln2 = angka(document.getElementById('bulan2').value);
        var cbln1x = document.getElementById('bulan1').value;
        var cbln2x = document.getElementById('bulan2').value;
        var cketentuan = '';
        var csdana = $('#sdana').combogrid('getValue');
    	var cjenis = document.getElementById('jenis').value;
        var ctotal = angka(document.getElementById('total').value);
        var cnomor2 = document.getElementById('nomor2').value;
    	var nlpj = $('#nlpj').combogrid('getValue');
    	var jeniss = document.getElementById('jeniss').value;
		        
        if(cbln1x==0 || cbln1x=='')
        { swal({
          title:"<a style='font-size:large;'>Pilihan Bulan Awal Tidak Boleh Kosong </a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "red",
          html:true,
          type: "warning",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        });
            exit();
        }
        if(cbln2x==0 || cbln2x=='')
        { swal({
          title:"<a style='font-size:large;'>Pilihan Bulan Akhir Tidak Boleh Kosong </a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "red",
          html:true,
          type: "warning",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        });
            exit();
        }
        if (cno==''){
      swal({
          title:"<a style='font-size:large;'>Nomor SPD Tidak Boleh Kosong </a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "red",
          html:true,
          type: "warning",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        });
            
            exit();
        } 
        if (ctgl==''){
      swal({
          title:"<a style='font-size:large;'>Tanggal SPD Tidak Boleh Kosong </a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "red",
          html:true,
          type: "warning",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        });
            exit();
        }
        if (cskpd==''){
      swal({
          title:"<a style='font-size:large;'>Kode SKPD Tidak Boleh Kosong! </a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "red",
          html:true,
          type: "warning",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        });
            exit();
        }
        if(cbln2<cbln1){
      swal({
          title:"<a style='font-size:large;'>Bulan Akhir Tidak Boleh Lebih Kecil Dari Bulan Awal </a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "red",
          html:true,
          type: "warning",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        });
            exit();
        }
        if(lcstatus=='tambah'){
          cek_no();
        }
        if(ctotal==0){
      swal({
          title:"<a style='font-size:large;'>Nilai Tidak Boleh Nol</a> " ,
          text: "Akan Menutup Dalam 2 Detik!!!",
          confirmButtonColor: "red",
          html:true,
          type: "warning",
          timer: 3500,
          confirmButtonText: "Ya",
          showConfirmButton: true
        });
          exit();
        }
		
		var	weton = '<?php echo date("Y"); ?>';
		
		if ( jeniss == '1'){
			if(nlpj==''){
				var zzz = '/SPD/UP/'+no_sdana+'/'+cskpd+'/'+weton;
			}else{
				var zzz = '/SPD/GU/'+no_sdana+'/'+cskpd+'/'+weton;
			}			
		} else if (jeniss == '2'){
			var zzz = '/SPD/TU/'+no_sdana+'/'+cskpd+'/'+weton;
		} else if (jeniss == '3'){
			var zzz = '/SPD/LS/'+no_sdana+'/'+cskpd+'/'+weton;
		} else if (jeniss == '4'){
			var zzz = '/SPD/LSBEND/'+no_sdana+'/'+cskpd+'/'+weton;
		}

        $(document).ready(function(){
            $.ajax({
                type: "POST",    
                dataType:'json',                            
                data: ({tabel:'trhspd',no:cno+zzz,tgl:ctgl,skpd:cskpd,nmskpd:cnmskpd,bend:cbend,bln1:cbln1,bln2:cbln2,ketentuan:cketentuan,sdana:csdana,jenis:cjenis,total:ctotal,nomorx:cnomor2,ccek:cek,nolpj:nlpj,jeniss:jeniss}),
                url: '<?php echo base_url(); ?>/index.php/rka/simpan_spd', 
                success:function(data){
                    status = data.pesan; 
          
          save_detail(status);
          if(status =='1'){
            alert('Data Berhasil Disimpan');
            section1();
          }else if(status =='0'){
            alert('Data Gagal Disimpan  ..!!');
          }else{
            alert('No SPD '+cno+' telah Terpakai  ..!!');
          }
                }
            });
        });
        
       
    }
  
  function save_detail(x){
    var kim=x;
    var cno = document.getElementById('nomor').value;
    var ctgl = $('#tanggal').datebox('getValue');
    var cskpd = $('#skpd').combogrid('getValue');
    var cnmskpd = document.getElementById('nmskpd').value;
    var cbend = $('#bendahara').combogrid("getValue");
    var cbln1 = document.getElementById('bulan1').value;
    var cbln2 = document.getElementById('bulan2').value;
    var cketentuan = '';
    var csdana = $('#sdana').combogrid('getValue');
    var cjenis = document.getElementById('jenis').value;
    var ctotal = angka(document.getElementById('total').value);
    var cnomor2 = document.getElementById('nomor2').value;
	var jeniss = document.getElementById('jeniss').value;
	var nlpj = $('#nlpj').combogrid('getValue');
	
	var	weton = '<?php echo date("Y"); ?>';
		
		if ( jeniss == '1'){
			if(nlpj==''){
				var zzz = '/SPD/UP/'+no_sdana+'/'+cskpd+'/'+weton;
			}else{
				var zzz = '/SPD/GU/'+no_sdana+'/'+cskpd+'/'+weton;
			}			
		} else if (jeniss == '2'){
			var zzz = '/SPD/TU/'+no_sdana+'/'+cskpd+'/'+weton;
		} else if (jeniss == '3'){
			var zzz = '/SPD/LS/'+no_sdana+'/'+cskpd+'/'+weton;
		} else if (jeniss == '4'){
			var zzz = '/SPD/LSBEND/'+no_sdana+'/'+cskpd+'/'+weton;
		} 
		
    if (kim =='1'){
            $('#dg1').datagrid('selectAll');
            var rows = $('#dg1').datagrid('getSelections');           
      for(var p=0;p<rows.length;p++){
                cnospd   = cno+zzz;
                cnilai   = angka(rows[p].nilai);                 
                if (p>0) {
                    csql = csql+","+"('"+cnospd+"','"+cnilai+"','"+csdana+"')";
                } else {
                    csql = "values('"+cnospd+"','"+cnilai+"','"+csdana+"')";                                            
                } 
      }
       $(document).ready(function(){
                $.ajax({
                    type: "POST",    
                    dataType:'json',                    
                    data: ({tabel:'trdspd',no:cno+zzz,sql:csql,nomorx:cnomor2,ccek:cek,csdana:csdana}),
                    url: '<?php echo base_url(); ?>/index.php/rka/simpan_spd',
                    success:function(data){
                          
                    }                                        
                });
            });                        
        }
  }

  function cek_no(){
    var cno = document.getElementById('nomor').value; 

    $.ajax({
      type:'post',
      data:({no:cno}),
      url :"<?php echo base_url(); ?>/index.php/rka/cekno",
      dataType:"json",
      success:function(data){
        $.each(data,function(i,n){
            var xxx = n['jumlah'];
            if(xxx==1){
              alert('No SPD '+cno+' telah Terpakai  ..!!');
              keluar();
            }
        });
      }
    });
  }

    function spdlalu(){
       
        var skpd = $('#skpd').combogrid('getValue'); 
        var cjenis = document.getElementById('jenis').value;
        var cno = document.getElementById('nomor').value; 
        var sumber = $('#sdana').combogrid('getValue');
            $.ajax({
                type: 'POST',
                data: ({csumber:sumber,cjenis:cjenis,no:cno,cskpd:skpd}),
                url: "<?php echo base_url(); ?>/index.php/rka/spd_lalu",
                dataType:"json",              
                success:function(data){
                    $.each(data, function(i,n){
                        var ang = angka(document.getElementById('anggaran_ubah').value);
                        var cspdLalu_ = n['lalux'];
                        var cspdLalu=n['lalux'];
                        var sis = ang-cspdLalu_;
                        $("#lalu").attr("value",number_format(cspdLalu,0,'.',','));
                        $("#sisa").attr("value",number_format(sis,0,'.',','));
                  });
                }
            });
      }
    
    function sisa_spd(){
        var ang = angka(document.getElementById('anggaran_ubah').value);
        var lalu = angka(document.getElementById('lalu').value);
        var nil = angka(document.getElementById('nilai').value); 
        var bln_akhir= document.getElementById('bulan2').value;
    //var tw1= angka(document.getElementById('tw1').value);
    //var tw2= angka(document.getElementById('tw2').value);
    //var tw3= angka(document.getElementById('tw3').value);
    //var tw4= angka(document.getElementById('tw4').value);
    var jenis = document.getElementById('jenis').value;
    
  
        sisa = ang - lalu;
        slalu = (sisa - nil); 
        $("#selisih").attr("value",number_format(slalu,0,'.',','));   
        if (slalu < 0){
                alert('Nilai Melebihi SPD Lalu');
                exit();                
        }
    }
  
      
    function tes(){
     var url    = "<?php echo site_url(); ?>/rka/setuju_spd";  
     window.open(url);
      window.focus();
    }

  </script>

</head>
<body>



<div id="content">    
<div id="accordion">
<h3><a href="#" id="section1">Daftar SPD</a></h3>
    <div>
     <input style="background-color:skyblue;width:20px;border:solid 1px #000000;" disabled/>
        <b>#Sudah di setujui</b>&nbsp;
        <input style="background-color:#FFF;width:20px;border:solid 1px #000000;" disabled/>
        <b>#Belum di setujui </b>  
    <p align="center"> 
        <a class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:tes();">BUKA FORM SETUJUI</a>    
        </p>
      <p align="right"> 
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();section2();">Tambah</a>               
        <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="dg" title="List SPD" style="width:870px;height:470px;" >  
        </table>                          
    </p> 
    </div>   

<h3><a href="#" id="section2">S P D</a></h3>
   <div  style="height: 350px;">
   <p id="p1" style="font-size: 20px;color: red;"></p>
   <p>       
        <table align="center" border='1' style="width:870px;">
        
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td colspan="5" style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;</td>
            </tr>                        


            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">No. SPD</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="nomor"  maxlength="5" style="width: 200px;" onclick="javascript:select();"/></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="hidden" id="nomor2" style="width: 180px;"/></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Tanggal SPD</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">&nbsp;&nbsp;<input type="text" id="tanggal" style="width: 140px;" /></td>     
            </tr>                        
            
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">S K P D</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input id="skpd" name="skpd" style="width: 140px;" /></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Nama SKPD :</td> 
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">&nbsp;&nbsp;<input type="text" id="nmskpd" style="border:0;width: 400px;" readonly="true"/></td>                                
            </tr>
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Atas Beban</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"><?php echo $this->rka_model->combo_beban('jenis','onchange="javascript:beban();"'); ?></td>                
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Kebutuhan Bulan</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;"><?php echo $this->rka_model->combo_bulan('bulan1','onchange="javascript:validateX();"'); ?> s/d <?php echo $this->rka_model->combo_bulan('bulan2','onchange="javascript:validateX();"'); ?></td>
            </tr>                        
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">JENIS SPP</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"><?php echo $this->tukd_model->combo_jbeban('jeniss','onchange="javascript:jbeban();"'); ?></td>
				<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"></td>
				<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Sumber Dana</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="sdana" style="width:200px; "/></td>                
            </tr>
      <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">NO LPJ</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input id="nlpj"  name="nlpj" style="width:140px; " /></td>
        <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"><input type="hidden" id="nillpj"  name="nillpj" style="width:140px; " /></td>
		<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Bendahara</td>
                <td colspan='5' style="border-bottom-style:hidden;padding:5px;border-spacing:5px 5px 5px 5px;">&nbsp;<input type="text" id="bendahara" style="width: 250px;"/><input type="text" id="nip" style="width: 100px;" hidden/></td>
            </tr>     
                      
            <tr style=";padding:3px;border-spacing:5px 5px 5px 5px;">
                <td colspan="5" style="padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;border-bottom-color:black;">&nbsp;</td>
            </tr>                        

            
        </table>          
        
        <table id="dg1" title="Detail S P D" style="width:870px;height:300px;" >  
        </table>  
        
        <div id="toolbar" align="right">
    
            <a class="easyui-linkbutton" iconCls="icon-add" plain="false" id="tambahdetail" onclick="javascript:tambah();">Tambah Detail</a>
            <a class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus_giat();">Hapus Detail</a>
                  
        </div>
        <table align="center" style="width:100%;">
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td ></td>
            <td align="right">Total : <input type="text" id="total" style="font-size: large;border:0;width: 200px;text-align: right;" readonly="true"/></td>
        </tr>
        </table>		
		<table align="center" style="width:100%;">
			<tr>
				<td style="padding:3px;border-spacing:5px 5px 5px 5px;border-bottom-style:hidden;" colspan="5" align="center">
				<a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();">Tambah</a>
                <a class="easyui-linkbutton" id="save" iconCls="icon-save" plain="false" onclick="javascript:simpan_spd();">Simpan</a>
                <a class="easyui-linkbutton" id="hapus" iconCls="icon-remove" plain="false" onclick="javascript:hapus();">Hapus</a>
                <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:cetak();">Cetak</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:section1();">Kembali</a>                                   
                </td>
			</tr>
        </table>
                
   </p>
   </div>
   
</div>
</div>


<div id="dialog-modal" title="Input Detail">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
    <table border="0">
        
        <tr> 
           <td width="30%">Anggaran</td>
           <td>:</td>
           <td><input type="text" id="anggaran_ubah" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/><input type="hidden" id="anggaran" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/></td>
           
           <td>&nbsp;</td>
           <td>&nbsp;</td>           
           <!--<td>TW 1</td>
           <td>:</td>
           <td><input type="text" id="tw1" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/></td>-->
        </tr>
        <tr> 
           <td width="30%">Yang Telah di SPD kan</td> <!--bukan Lalu, tapi yang sudah di SPDkan untuk Kontrol buat tidak melebihi anggaran saat edit yang lalu-->
           <td>:</td>
           <td ><input type="text" id="lalu" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/></td>
            <td>&nbsp;</td>
           <td>&nbsp;</td>
           <!--<td>TW 2</td>
           <td>:</td>
           <td><input type="text" id="tw2" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/></td>-->
           
           
        </tr>
        <tr> 
           <td width="30%">Sisa Anggaran</td> 
           <td>:</td>
           <td ><input type="text" id="sisa" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/></td>
            <td>&nbsp;</td>
           <td>&nbsp;</td>
           <!--<td>TW 3</td>
           <td>:</td>
           <td><input type="text" id="tw3" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/></td> -->
           
        </tr>
        <tr> 
           <td width="30%">Nilai</td>
           <td>:</td>
           <td ><input type="text" id="nilai" name="nilai"style="text-align: right;" onkeyup="javascript:sisa_spd();" /></td>
            <td>&nbsp;</td>
           <td>&nbsp;</td>
           <!--<td>TW 4</td>
           <td>:</td>
           <td><input type="text" id="tw4" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/></td>-->
        </tr>
        </tr>
        <tr> 
           <td width="30%">Selisih</td>
           <td>:</td>
           <td><input type="text" id="selisih" readonly="true" style="text-align: right;" onkeyup="javascript:sisa_spd();" /></td>
           
           
    </table>  
    </fieldset>
    <fieldset>
    <table align="center">
        <tr>
            <td><a id="save_keg" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:append_save();">Simpan</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>
            </td>
        </tr>
    </table>
    </fieldset>

   <div  align="center">
    <table>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
   </div>
     <table id="dg2" title="Detail S P D" style="width:800px;height:250px;" >  
       </table>  
   <div  align="right">Total : <input type="text" id="total1" style="font-size: large;border:0;width: 200px;text-align: right;" readonly="true"/></div>
</div>

<div id="dialog-cetak" title="Cetak SPD">  
    <fieldset>
    <form target="_blank" method="POST" id="frm_ctk" >
    <table border="0">
        <tr>
            <td width="30%">Nomor SPD</td>
            <td width="1%">:</td>
            <td><input type="text" id="nomor1" style="border: 0;" name="nomor1" readonly="true" /></td>
        </tr>
    <tr>
            <td>Jenis Belanja</td>
            <td>:</td>
            <td><input type="text" id="jnsrek" style="border: 0;" name="jnsrek" readonly="true" /></td>
        </tr>
        <!-- <tr>
      <td colspan="3" align="center"><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />Otorisasi SPD
      <input type="radio"  name="cetak" value="2" onclick="opt(this.value)"/>Lampiran SPD
      </td>
    </tr> -->
    
    </table>
    </fieldset>
    <fieldset>
    <table align="center">
        <tr>
            <td><a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="submit()" >Print</a>               
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>
            </td>
        </tr>
    </table>
    </form>
    </fieldset>
   
</div>

<div id="dialog-pass" title="Hapus SPD<br>Silahkan Masukan Username dan Password KABID">  
    <fieldset>
    <form target="_blank" method="POST" id="frm_ctk" >
    <table border="0">
        <tr>
            <td width="30%">Nomor SPD</td>
            <td width="1%">:</td>
            <td><input type="text" id="nomor18" style="border: 0;" name="nomor18" readonly="true" /></td>
        </tr>
        <tr>
            <td>Jenis Belanja</td>
            <td>:</td>
            <td><input type="text" id="jnsrek18" style="border: 0;" name="jnsrek18" readonly="true" /></td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><input type="text" id="usr" style="border: 0;" name="usr" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" id="pass" style="border: 0;" name="pass" /></td>
        </tr>
    
    </table>
    </fieldset>
    <fieldset>
    <table align="center">
        <tr>
            <td><a class="easyui-linkbutton" iconCls="icon-ok" plain="false" onclick="cek_usr_pass();" >OK</a>               
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>
            </td>
        </tr>
    </table>
    </form>
    </fieldset>
   
</div>

</body>

</html>