    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">

    
    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
      <link href='<?php echo base_url();?>assets/js/jquery.autocomplete.css' rel='stylesheet' />
    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>
   
    <script type="text/javascript"> 
    
    var nl =0;
    var tnl =0;
    var idx=0;
    var tidx=0;
    var oldRek=0;
    var rek=0;
    
    $(function(){
         $('#dd').datebox({  
            required:true,
            formatter :function(date){
                var y = date.getFullYear();
                var m = date.getMonth()+1;
                var d = date.getDate();
                return y+'-'+m+'-'+d;
            }
        });
    });


 $(function(){
         $('#icad').datebox({  
            required:true,
            formatter :function(date){
                var y = date.getFullYear();
                var m = date.getMonth()+1;
                var d = date.getDate();
                return y+'-'+m+'-'+d;
            }
        });
    });

        $(function(){
            $('#csp2d').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/pilih_sp2d',  
                    idField:'no_sp2d',                    
                    textField:'no_sp2d',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'no_sp2d',title:'SP2D',width:60},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:60},
                        {field:'no_spm',title:'SPM',width:60} 
                          
                    ]],
                    onSelect:function(rowIndex,rowData){
                    kode = rowData.no_sp2d;
                    dns = rowData.kd_skpd;
                    val_ttd(dns);
                    }   
                });
           });
           
        function val_ttd(dns){
           $(function(){
            $('#ttd').combogrid({  
                panelWidth:700,  
                url: '<?php echo base_url(); ?>/index.php/tukd/pilih_ttd2/'+dns,  
                    idField:'nip',                    
                    textField:'nama',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'nip',title:'NIP',width:100},  
                        {field:'nama',title:'NAMA',align:'left',width:150},
						{field:'jabatan',title:'JABATAN',align:'left',width:250}
                    ]],
                    onSelect:function(rowIndex,rowData){
                    nip = rowData.nip;
                    
                    }   
                });
           });              
         }
    $(function(){ 
     $('#sp2d').edatagrid({
        url: '<?php echo base_url(); ?>/index.php/tukd/load_sp2d',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        toolbar:"#ddd", 
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
            {field:'no_sp2d',title:'Nomor SP2D',width:150,align:"left"},          
            {field:'tgl_sp2d',title:'Tanggal',width:70},
			{field:'nm_skpd',title:'SKPD',width:150,align:"left"},           
            {field:'keperluan',title:'Keterangan',width:100,align:"left"},
			{field:'nilai',title:'Nilai',width:80,align:"right"}
        ]],
        onSelect:function(rowIndex,rowData){
		no_sp2d = rowData.no_sp2d;
		sp2d = rowData.sp2d;
		sp2d2 = rowData.sp2d2;
         sp2d_advis = rowData.sp2d_advis;
          no_spm = rowData.no_spm;
          tgs  = rowData.tgl_sp2d;
          st = rowData.status; 
        tgspm = rowData.tgl_spm
        no_spp = rowData.no_spp;         
        dn  = rowData.kd_skpd;
        sp  = rowData.no_spd;          
        bl  = rowData.bulan;
        tg  = rowData.tgl_spp;
        jn  = rowData.jns_spp;
        kep  = rowData.keperluan;
        np  = rowData.npwp;
        rekan  = rowData.nmrekan;
        bk  = rowData.bank;
        ning  = rowData.no_rek;
        nm  = rowData.nm_skpd;

          getspm(no_sp2d,no_spm,tgs,st,tgspm,no_spp,dn,sp,tg,bl,jn,kep,np,rekan,bk,ning,nm,sp2d,sp2d2);                                                      
          detail();
          pot();
        },
        onDblClickRow:function(rowIndex,rowData){
            section2();
            $("#no_sp2d").attr("disabled",true);
            $("#nospm").combogrid("disable");
            $("#dd").datebox("disable");
                    
        }
    });
    }); 
        
              
   $(function(){
            $('#nospm').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/nospmsp2d',  
                    idField:'no_spm',                    
                    textField:'no_spm',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'no_spm',title:'No',width:200},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:50},
                        {field:'tgl_spm',title:'Tgl SPM',align:'left',width:50}                           
                    ]],
                     onSelect:function(rowIndex,rowData){

                        spm2 = rowData.spm2
                        no_spm = rowData.no_spm
                        tgspm = rowData.tgl_spm
                        no_spp = rowData.no_spp;         
                        dn  = rowData.kd_skpd;
                        sp  = rowData.no_spd;          
                        bl  = rowData.bulan;
                        tg  = rowData.tgl_spp;
                        jn  = rowData.jns_spp;
                        kep  = rowData.keperluan;
                        np  = rowData.npwp;
                        rekan  = rowData.nmrekan;
                        bk  = rowData.bank;
                        ning  = rowData.no_rek;
                        nm  = rowData.nm_skpd;        
                        get(no_spm,tgspm,no_spp,dn,sp,tg,bl,jn,kep,np,rekan,bk,ning,nm);
                        
                        gabung();
                                //alert(spm2);
                       detail();
                       pot();                                                              
                    }  
                });
           });
 
 
 
 
   function gabung()
{
    
    

 $("#dua").attr("value",spm2);


  var a = document.getElementById('satu').value;
  var b = document.getElementById('dua').value;


  gabung1=a+""+b;


  $("#no_sp2d").attr("value",gabung1);
    $("#no_sp2dx").attr("value",gabung1);

}
   
   
   
   function gabungXX()
{ var a = document.getElementById('satu').value;
  var b = document.getElementById('dua').value;
  gabung1=a+""+b;
  $("#no_sp2d").attr("value",gabung1);
  $("#no_sp2dx").attr("value",gabung1);
}
   
   
             
        $(function(){
            $('#dg').edatagrid({
                url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                 autoRowHeight:"true",
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 singleSelect:"true"
                                  
            });
        }); 
        
        
        
        $(function(){
            $('#pot').edatagrid({
                url: '<?php echo base_url(); ?>/index.php/tukd/pot',
                 autoRowHeight:"true",
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 singleSelect:"true",
                                  
            });
        }); 
    
  
        
        function detail(){
        $(function(){            
            $('#dg').edatagrid({
                url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                queryParams:({spp:no_spp}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,
                 onLoadSuccess:function(data){                      
                      load_sum_spm();
                      },                                                             
                 columns:[[
                    {field:'ck',
                     title:'ck',
                     checkbox:true,
                     hidden:true},                     
                     {field:'kdkegiatan',
                     title:'Kegiatan',
                     width:150,
                     align:'left'
                    },
                    {field:'kdrek5',
                     title:'Rekening',
                     width:70,
                     align:'left'
                    },
                    {field:'nmrek5',
                     title:'Nama Rekening',
                     width:400                   
                    },
                    {field:'nilai',
                     title:'Nilai',
                     width:130,
                     align:'right'
                     }
                      
                ]]  
            
            });
    

        });
        }
        
        function detail1(){
        $(function(){ 
            var no_spp='';
            $('#dg').edatagrid({
                url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                queryParams:({spp:no_spp}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,                                                                             
                 columns:[[
                    {field:'ck',
                     title:'ck',
                     checkbox:true,
                     hidden:true},                     
                     {field:'kdkegiatan',
                     title:'Kegiatan',
                     width:150,
                     align:'left'
                    },
                    {field:'kdrek5',
                     title:'Rekening',
                     width:70,
                     align:'left'
                    },
                    {field:'nmrek5',
                     title:'Nama Rekening',
                     width:300                   
                    },
                    {field:'sisa',
                     title:'Sisa',
                     width:100,
                     align:'right'               
                     },
                    {field:'nilai1',
                     title:'Nilai',
                     width:100,
                     align:'right'
                     }
                      
                ]]  
            
            });
    

        });
        }
        
        
        
         function pot(){
        $(function(){
            $('#pot').edatagrid({
                url: '<?php echo base_url(); ?>/index.php/tukd/pot',
                queryParams:({spm:no_spm}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,
                 onLoadSuccess:function(data){                      
                      load_sum_pot();
                      },                                                         
                 columns:[[
                    {field:'ck',
                     title:'ck',
                     checkbox:true,
                     hidden:true},                    
                    {field:'kd_rek5',
                     title:'Rekening',
                     width:100,
                     align:'left'
                    },
                    {field:'nm_rek5',
                     title:'Nama Rekening',
                     width:500
                    },                    
                    {field:'nilai',
                     title:'Nilai',
                     width:100,
                     align:'right'
                     },
                     {field:'pot',
                     title:'ket',
                     width:30,
                     align:'center'
                     }
                      
                ]]  
            
            });
    

        });
        }
        
        function pot1(){
        $(function(){
            var no_spm='';                         
            $('#pot').edatagrid({
                url: '<?php echo base_url(); ?>/index.php/tukd/pot',
                queryParams:({spm:no_spm}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,                                                                         
                 columns:[[
                    {field:'ck',
                     title:'ck',
                     checkbox:true,
                     hidden:true},                    
                    {field:'kd_rek5',
                     title:'Rekening',
                     width:100,
                     align:'left'
                    },
                    {field:'nm_rek5',
                     title:'Nama Rekening',
                     width:500
                    },                    
                    {field:'nilai',
                     title:'Nilai',
                     width:100,
                     align:'right'
                     },
                     {field:'pot',
                     title:'ket',
                     width:30,
                     align:'center'
                     }
                      
                ]]  
            
            });
    

        });
        }
              
        function get(no_spm,tgspm,no_spp,kd_skpd,no_spd,tgl_spp,bulan,jns_spp,keperluan,npwp,rekanan,bank,rekening,nm_skpd){
        $("#no_spm").attr("value",no_spm);
        $("#tgl_spm").attr("value",tgspm);
        $("#nospp").attr("value",no_spp);
        $("#dn").attr("value",kd_skpd);
        $("#sp").attr("value",no_spd);        
        $("#tgl_spp").attr("value",tgl_spp);
        $("#kebutuhan_bulan").attr("Value",bulan);
        $("#ketentuan").attr("Value",keperluan);
        $("#jns_beban").attr("Value",jns_spp);
        $("#npwp").attr("Value",npwp);
        $("#rekanan").attr("Value",rekanan);
        $("#bank1").attr("Value",bank);
        $("#rekening").attr("Value",rekening);
        $("#nmskpd").attr("Value",nm_skpd);
                    
        }
                  
        function getspm(no_sp2d,no_spm,tgl_sp2d,status,tgspm,no_spp,kd_skpd,no_spd,tgl_spp,bulan,jns_spp,keperluan,npwp,rekanan,bank,rekening,nm_skpd,sp2d,sp2d2){


        $("#no_sp2d").attr("value",no_sp2d);
        $("#no_sp2dx").attr("value",no_sp2d);
        $("#nospm").combogrid("setValue",no_spm);
        $("#dd").datebox("setValue",tgl_sp2d);
        $("#tgl_spm").attr("value",tgspm);
        $("#nospp").attr("value",no_spp);
        $("#dn").attr("value",kd_skpd);
        $("#sp").attr("value",no_spd);        
        $("#tgl_spp").attr("value",tgl_spp);
        $("#kebutuhan_bulan").attr("Value",bulan);
        $("#ketentuan").attr("Value",keperluan);
        $("#jns_beban").attr("Value",jns_spp);
        $("#npwp").attr("Value",npwp);
        $("#rekanan").attr("Value",rekanan);
        $("#bank1").attr("Value",bank);
        $("#rekening").attr("Value",rekening);
        $("#nmskpd").attr("Value",nm_skpd);
        $("#pass").attr("value",'');
        $("#usr").attr("value",'');
        
        $("#satu").attr("value",sp2d);
        $("#dua").attr("value",sp2d2);
        tombol(status);                   
        }
		
		function oto(){	
			$.ajax({
        		url: '<?php echo base_url(); ?>index.php/tukd/load_oto_sp2d',
				type: "POST",
        		dataType:"json",                         
        		success:function(data){
					$("#satu").attr("value",data.u);
			  	}                                     
       		});    
    	}
        
        function kosong(){
		asu = oto();
        $("#satu").attr("disabled",false);
		$("#dua").attr("disabled",true);

        cdate = '<?php echo date("Y-m-d"); ?>';
        $("#nospm").combogrid("enable");
        $("#no_sp2d").attr("disabled",false);
        $("#no_sp2d").attr("value",'');
        $("#pass").attr("value",'');
        $("#usr").attr("value",'');
        
		$("#satu").attr("value",asu);
		$("#dua").attr("value",'');
                
        $("#no_sp2dx").attr("value",'');
        $("#dd").datebox("setValue",cdate);
        $("#dd").datebox("enable");
        $("#nospm").combogrid("clear");
        $("#nospp").attr("value",'');
        $("#rek_bud").attr("value",'');
        $("#dn").attr("value",'');
        $("#sp").attr("value",'');        
        $("#tgl_spp").attr("value",'');
        $("#tgl_spm").attr("value",'');
        $("#kebutuhan_bulan").attr("Value",'');
        $("#ketentuan").attr("Value",'');
        $("#jns_beban").attr("Value",'');
        $("#npwp").attr("Value",'');
        $("#rekanan").attr("Value",'');
        $("#bank1").attr("Value",'');
        $("#rekening").attr("Value",'');
        $("#nmskpd").attr("Value",''); 
        $("#rekspm").attr("value",'');
        $("#rekspm1").attr("value",''); 
        $("#rektotal").attr("value",''); 
        document.getElementById("p1").innerHTML="";
        detail1();
        pot1(); 
        $("#nospm").combogrid("clear");
        tombolnew();  
        reaload_spm();
            
        }


        $(document).ready(function() {
            $("#accordion").accordion();
            $("#lockscreen").hide();                        
            $("#frm").hide();
            $("#dialog-modal").dialog({
                height: 200,
                width: 700,
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
       
    function cetak(){
        $('#csp2d').combogrid('grid').edatagrid('reload');
        var nom=document.getElementById("no_sp2d").value;
        $("#csp2d").combogrid("setValue",nom);
        $("#dialog-modal").dialog('open');
    } 

    //Demansyah 24 Januari 2016
    function passwd(){
      var cnomor = document.getElementById('no_sp2d').value;
      var jns = document.getElementById('jns_beban').value;
      $("#dialog-pass").dialog('open');
      $('#nomor18').attr('value',cnomor);
      $('#jnsrek18').attr('value',jns);
    }

    function cek_usr_pass(){
      var usr = document.getElementById('usr').value;
      var pswd= document.getElementById('pass').value;

      if(usr!='george krey'){
        alert('Username dan Password Salah!');
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
                hhapus();
              }else{
                alert('Username dan Password Salah!');
                $('#usr').attr('value','');
                $('#pass').attr('value','');
                exit();
              }
            });
         }
      });
    }
    
    function keluar(){
        $("#dialog-modal").dialog('close');
        $("#dialog-pass").dialog('close');
    }   
     function cari(){
     var icad = $('#icad').datebox('getValue'); 
     var kriteria = document.getElementById("txtcari").value; 
        $(function(){ 
            $('#sp2d').edatagrid({
           url: '<?php echo base_url(); ?>/index.php/tukd/load_sp2d',
         queryParams:({cari:kriteria,icad:icad})
        });        
     });
    }


    function cari2(){
  
  
  var xxx = document.getElementById("xxx").value; 
  $(function(){ 
    $('#sp2d').edatagrid({
      url: '<?php echo base_url(); ?>/index.php/tukd/load_sp2d',
      queryParams:({xxx:xxx})
    });        
  });
}
        
       function simpan_sp2d(){        
        var a1 = document.getElementById('no_sp2d').value;
        var b1 = $('#dd').datebox('getValue');        
        var b2 =document.getElementById('tgl_spm').value;
        var b = document.getElementById('tgl_spp').value;      
        var c = document.getElementById('jns_beban').value; 
        var d = document.getElementById('kebutuhan_bulan').value;
        var e = document.getElementById('ketentuan').value;
        var f = document.getElementById('rekanan').value;
        var g = document.getElementById('bank1').value;
        var h = document.getElementById('npwp').value;
        var i = document.getElementById('rekening').value;
        var j = document.getElementById('nmskpd').value;
        var k = document.getElementById('dn').value;
        var l = document.getElementById('sp').value;
        var m = document.getElementById('rekspm1').value;
        var ek= document.getElementById('no_sp2dx').value;
        var bud = document.getElementById('rek_bud').value;
        $(function(){      
         $.ajax({
            type: 'POST',
            data: ({cskpd:k,cspd:l,no_sp2d:a1,tgl_sp2d:b1,no_spm:no_spm,tgl_spm:b2,no_spp:no_spp,tgl_spp:b,jns_spp:c,bulan:d,keperluan:e,nmskpd:j,rekanan:f,bank:g,npwp:h,rekening:i,nilai:m,cek:ek,rek_bud:bud}),
            dataType:"json",
            url:"<?php echo base_url(); ?>index.php/tukd/simpan_sp2d",
            success:function(data){
                if (data=='1'){
        swal({
              title: 'Data Tersimpan..!!',
              text: "Akan Menutup Dalam 2 Detik!!!",
              confirmButtonColor: "#80C8FE",
              type: "success",
              timer: 3500,
              confirmButtonText: "Ya",
              showConfirmButton: true
            });
                    $('#sp2d').edatagrid('reload');
                    section1();
                }else if ( data=='2'){
                     alert('Nomor SP2D Sudah Terpakai...!!!,  Ganti Nomor SP2D...!!!');
                }else{
                    alert('Data Gagal Tersimpan');

                }
            }
         });
        });
        }
    
  
                  
         function hhapus(){ 
            $("#dialog-pass").dialog('close');          
            var sp2d = document.getElementById("no_sp2d").value;
            var stj = document.getElementById('usr').value; 
                         
            var urll= '<?php echo base_url(); ?>/index.php/tukd/hapus_sp2d_dh';                             
            if (sp2d !=''){
                var del=confirm('Anda yakin akan menghapus SP2D '+sp2d+'  ?');
                if  (del==true){
                    $(document).ready(function(){
                    $.post(urll,({no:sp2d,spm:no_spm,stj:stj}),function(data){
                    status = data;
                        $('#sp2d').edatagrid('reload');
                        section1();
                    });
                    });
                
                }
                } 
        }
        
        
        
        function load_sum_spm(){           
        $(function(){      
         $.ajax({
            type: 'POST',
            data:({spp:no_spp}),
            url:"<?php echo base_url(); ?>index.php/tukd/load_sum_spm",
            dataType:"json",
            success:function(data){ 
                $.each(data, function(i,n){
                    $("#rekspm").attr("value",n['rekspm']);
                    $("#rekspm1").attr("value",n['rekspm1']);
                });
            }
         });
        });
    }         
        
        function load_sum_pot(){                
        $(function(){      
         $.ajax({
            type: 'POST',
            data:({spm:no_spm}),
            url:"<?php echo base_url(); ?>index.php/tukd/load_sum_pot",
            dataType:"json",
            success:function(data){ 
                $.each(data, function(i,n){
                    $("#rektotal").attr("value",n['rektotal']);
                });
            }
         });
        });
    }

     function section1(){
         $(document).ready(function(){    
             $('#section1').click();
             $('#sp2d').edatagrid('reload');                                               
         });
     }
     function section2(){
         $(document).ready(function(){    
             $('#section2').click();                                               
         });
     }
     function section3(){
         $(document).ready(function(){    
             $('#section3').click();                                               
         });
     }
     
     function tombol(st){  
     var rows = $('#sp2d').edatagrid('getSelected');
        var nom= rows.no_sp2d;
        var rows2 = $('#sp2d').edatagrid('getSelected');
        var nom1= rows2.sp2d_advis;

     if  ((nom==nom1) || (st=='1')) {
     $('#save').linkbutton('disable');
     $('#del').linkbutton('disable');
     $('#poto').linkbutton('disable');       
     document.getElementById("p1").innerHTML="Sudah di CAIRKAN!!";
     } else {
     $('#save').linkbutton('enable');
     $('#del').linkbutton('enable');
     $('#poto').linkbutton('enable');     
     document.getElementById("p1").innerHTML="";
     }
    }
    
    function tombolnew(){  
    
     $('#save').linkbutton('enable');
     $('#del').linkbutton('enable');   
    }
    
    function openWindow( url )
        {
      
        var no =kode.split("/").join("123456789");
        
        //      alert(no+"  "+kode+" "+dns);
        window.open(url+'/'+no+'/'+dns, '_blank');
        window.focus();
        }
        
        
    function pajak()
        {
            var nom=document.getElementById("no_sp2d").value;
            var url    = "<?php echo site_url(); ?>/tukd/cetak_nota_pajak";  
            var no =nom.split("/").join("123456789");
            window.open(url+'/'+no, '_blank');
            window.focus();
        }

    function pajak2()
        {   var rows = $('#sp2d').edatagrid('getSelected');
            var nom= rows.no_sp2d;
            var url    = "<?php echo site_url(); ?>/tukd/cetak_nota_pajak";  
            var no =nom.split("/").join("123456789");
            window.open(url+'/'+no, '_blank');
            window.focus();
        }
    function pajak3()
        {   var nom = $('#csp2d').combogrid('getValue');
            var url    = "<?php echo site_url(); ?>/tukd/cetak_nota_pajak";  
            var no =nom.split("/").join("123456789");
            window.open(url+'/'+no, '_blank');
            window.focus();
        }
    

    function cekdulu()
 {
     
     
        var sd=$('#dd').datebox('getValue');
        var lcno = document.getElementById('no_sp2d').value;
        var fd = document.getElementById("tgl_spm").value;
          var rekbud = document.getElementById("rek_bud").value;
        var a= sd.length;
        var bulanspp = fd.substr(5,2);
        var tglspp = fd.substr(8,10);
        var tahunspp = fd.substr(0,4);

         if(sd=='' || sd=='0000-00-00'){
            alert("Tanggal SP2D Tidak Boleh Kosong!!!");
            exit();
         }

         if(rekbud=='' ){
            alert("Rekening BUD Tidak Boleh Kosong!!!");
            exit();
         }
          if(lcno ==''){
               
                alert('Nomor SP2D Tidak Boleh kosong')
                document.getElementById('no_sp2d').focus();
                exit();
            }
         
        if (a==8){
            var tglspm = sd.substr(7,8);
            var bulanspm= sd.substr(5,1);
            var tahunspm = sd.substr(0,4);
        }else if(a==9){
            var tglspm =sd.substr(7,9);
            var tahunspm = sd.substr(0,4);
            var b= sd.substr(6,1);
        if(b=='-'){
            var bulanspm= sd.substr(5,1);
         }else{
            var bulanspm= sd.substr(5,2);
         }
        }else if(a==10){
            var tglspm = sd.substr(8,10);
            var bulanspm= sd.substr(5,2);
            var tahunspm = sd.substr(0,4);
         }
         
         if(tglspm<0){
             tglspm=tglspm*-1;
         }
         
         
        var tglsel=tglspm-tglspp;
        var blsel=bulanspm-bulanspp;
        var thnsel=tahunspm-tahunspp;

        
        
        
        if(thnsel<0)
        {
           alert("Tahun SP2D Tidak Boleh Lebih Kecil Dari Tahun SPP-SPM");
         exit();
        }else if(thnsel==0){
            
             if(blsel<0)
                {
                    alert("Bulan SP2D Tidak Boleh Lebih Kecil Dari Bulan SPP-SPM");
                    exit();
                }else if(blsel==0){
                        if(tglsel<0){
                            alert("Tanggal SP2D Tidak Boleh Lebih Kecil Dari Tanggal SPP-SPM");
                            }else{
                            //   alert("bb");
                            controlsp2d();
                            }
                }else if(blsel>0){
                        //alert("cc");
                        controlsp2d();
            
                        }
        
        }else if(thnsel>0){
         controlsp2d();
        }

    }

    function aaaaa(){ 
    var lll = document.getElementById('satu').value;
    z =lll.length
	var asik = $('#nospm').combogrid('getValue'); 
		if(z==4){
			if(asik!=''){
				 $("#dua").attr("disabled",false);
				$("#satu").attr("disabled",true);
			}else{
			  alert("Pilih dulu nomer SPM sebelum edit!!!");            
			}
		}else{
		  alert("isi dulu nomer sebelum edit!!!");
		}
    }


    function controlsp2d(){
        var cspp = no_spp;          
        var cskpd = document.getElementById('dn').value;
        var jnss = document.getElementById('jns_beban').value; 
        $(document).ready(function(){
        $.ajax({
            type: "POST",
            dataType : 'json',
            data: ({no:cspp,skpd:cskpd,jns:jnss}),
            url: '<?php echo base_url(); ?>/index.php/tukd/control_sp2d',
            success:function(data){
                if (data!=9){            
                        swal({
                                title:"<a style='font-size:large;'>Anggaran Rekening </a> <a style='color:red;font-size:large;'>"+data+"</a> <a style='font-size:large;'> sudah melebihi</a>" ,
                                text:"Cek Lagi Rekening",
                                html:true,
                                confirmButtonColor: "red",
                                type: "error",
                                timer: 10000,
                                confirmButtonText: "Ya",
                                showConfirmButton: true
                        });

                }else{
                    cek_no();
                }
            }
            });
        });
    }

    function cek_no(){
        var cno = document.getElementById('satu').value;
       //  $(document).ready(function(){
        $.ajax({
            type:'post',
            data:({no:cno}),
            url : "<?php echo base_url(); ?>/index.php/tukd/cekno_sp2d",
            dataType : "json",
            success:function(data){
                $.each(data,function(i,n){
                    var xxx = n['jumlah'];
                    if (xxx==1) {
                        swal({
                                title:"<a style='font-size:large;'>Nomor SP2D Sudah ada</a> <a style='color:red;font-size:large;'></a>" ,
                                text:"Cek NO SP2D",
                                html:true,
                                confirmButtonColor: "red",
                                type: "error",
                                timer: 10000,
                                confirmButtonText: "Ya",
                                showConfirmButton: true
                        });
                    }else{
                    simpan_sp2d();
                }
                });
            }
        });

        } 
 
 	function cek(){
        var lcno = document.getElementById('no_sp2d').value;
            if(lcno !=''){
               simpan_sp2d();               
            } else {
                alert('Nomor SP2D Tidak Boleh kosong')
                document.getElementById('no_sp2d').focus();
                exit();
            }
    }  
    
    function reaload_spm(){
            $('#nospm').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/nospmsp2d',  
                    idField:'no_spm',                    
                    textField:'no_spm',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'no_spm',title:'No',width:200},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:50},
                        {field:'tgl_spm',title:'Tgl SPM',align:'left',width:50} 
                          
                    ]],
                     onSelect:function(rowIndex,rowData){
                            spm2 = rowData.spm2
                        no_spm = rowData.no_spm
                        tgspm = rowData.tgl_spm
                        no_spp = rowData.no_spp;         
                        dn  = rowData.kd_skpd;
                        sp  = rowData.no_spd;          
                        bl  = rowData.bulan;
                        tg  = rowData.tgl_spp;
                        jn  = rowData.jns_spp;
                        kep  = rowData.keperluan;
                        np  = rowData.npwp;
                        rekan  = rowData.nmrekan;
                        bk  = rowData.bank;
                        ning  = rowData.no_rek;
                        nm  = rowData.nm_skpd;        
                        get(no_spm,tgspm,no_spp,dn,sp,tg,bl,jn,kep,np,rekan,bk,ning,nm);
                        
                        gabung();
                        //alert(spm2);
                       detail();
                       pot();                                                              
                    }  
                })
    }
    
    </script>
    <STYLE TYPE="text/css"> 
input.right{ 
         text-align:right; 
         } 
</STYLE> 

</head>
<body>



<div id="content">

<div id="accordion">
<h3><a href="#" id="section1" >Daftar SP2D</a></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:section2();kosong();">Tambah</a>
        <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:cetak();">Cetak SP2D</a>
        <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:pajak2();">Cetak Pajak</a>               
        <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <input id="icad" name="icad" type="text" readonly="true" style="width:150px ;"/>
        <table id="sp2d" title="Daftar SP2D" style="width:870px;height:465px;" >  
        </table>
                  
        
    </p> 
    </div>



  <div id="ddd" align="center">TAMPILKAN : 
	<select name="xxx" id="xxx"  align="center" onchange="cari2();" style="width:150px" >
			<option value="0">...KESELURUHAN... </option>
			<option value="51" >BTL</option>     
			<option value="52" >BL</option>     
			<option value="62" >pembiayaan</option> 
	</select> 
   </div>

<h3><a href="#" id="section2" onclick="javascript:$('#dg').edatagrid('reload')" >Input SP2D</a></h3>
   <div  style="height: 350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>
  <!-- <?php echo form_open('tukd/simpan', array('class' => 'basic')); ?> -->
               
<table border='1' style="font-size:11px" >

 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;</td>
 </tr>

 
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >No SP2D</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
    <input id="satu"  style="width: 50px;" maxlength="4"  onkeypress="return isNumberKeyTrue(event)" onkeyup="gabung();"/>  
                  <input type="text" id="dua" style="width: 300px;" onclick="javascript:select();" onkeyup="gabungXX();" disabled="disabled";/>  
                   <!--<a style="text-align:center" id="qqq" class="easyui-linkbutton" plain="false" onclick="javascript:aaaaa();">RUBAH</a>-->
   <input type="text" name="no_sp2d" id="no_sp2d" onclick="javascript:select();"  style="width:200px ;" hidden/><input type="text" name="no_sp2dx" id="no_sp2dx" onclick="javascript:select();"  style="width:100px ;" hidden/></td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tgl SP2D </td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="dd" name="dd" type="text" style="width:200px ;"/></td>
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">No SPM</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input type="text" name="nospm" id="nospm" style="width:300px ;" /></td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tgl SPM </td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="tgl_spm" disabled="disabled" name="tgl_spm" type="text" readonly="true" style="width:200px ;"/></td>
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">   
   <td width="8%"  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >No SPP</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input id="nospp" disabled="disabled" name="nospp" style="width:300px" readonly="true" /></td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tgl SPP </td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="tgl_spp" disabled="disabled" name="tgl_spp" type="text" readonly="true" style="width:200px ;" /></td>   
    </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">SKPD</td>
   <td width="53%"  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >     
      <input id="dn" disabled="disabled" name="dn" style="width:200px" readonly="true"/></td> 
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Bulan</td>
   <td width="31%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><select  name="kebutuhan_bulan" id="kebutuhan_bulan" disabled="disabled" style="width:200px ;" >
     <option value="">...Pilih Kebutuhan Bulan... </option>
     <option value="1" >1 | Januari</option>
     <option value="2">2 | Februari</option>
     <option value="3">3 | Maret</option>
     <option value="4">4 | April</option>
     <option value="5">5 | Mei</option>
     <option value="6">6 | Juni</option>
     <option value="7">7 | Juli</option>
     <option value="8">8 | Agustus</option>
     <option value="9">9 | September</option>
     <option value="10">10 | Oktober</option>
     <option value="11">11 | November</option>
     <option value="12">12 | Desember</option>
   </select></td> 
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><textarea name="nmskpd" id="nmskpd" disabled="disabled" cols="40" rows="1" style="border: 0;"  readonly="true"></textarea></td>
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Keperluan</td>
   <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><textarea name="ketentuan" id="ketentuan" disabled="disabled" cols="30" rows="1" ></textarea></td>
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">No SPD</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input id="sp" disabled="disabled" name="sp" style="width:300px" readonly="true"/></td>
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekanan</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><textarea id="rekanan" disabled="disabled" name="rekanan" cols="30" rows="1"  > </textarea></td>
 </tr>
 
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Beban</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><select name="jns_beban" id="jns_beban" disabled="disabled" style="width:200px;" >
     <option value="">...Pilih Jenis Beban... </option>
     <option value="1">UP</option>
     <option value="2">GU</option>
     <option value="3">TU</option>
     <option value="4">LS GAJI</option>
     <option value="5">LS PPKD</option>
     <option value="6">LS Barang Jasa</option>
     <option value="7">LS Bendahara</option>
   </select></td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Bank</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><?php
                                        $bank1="select * from ms_bank ";
                                        $pagingquery1 = $bank1; //echo "edit  $pagingquery1<br />";
                                        $res = mysql_query($pagingquery1)or die("pagingquery gagal".mysql_error());
                                ?>
     <select name="bank1" id="bank1" disabled="disabled" style="height: 27px; width: 200px;">
       <option value="">...Bank.. </option>
       <?php
         if($res)
          {
           while ($result = mysql_fetch_row($res)) 
             {
        ?>
       <option value="<?php echo $result[0]; ?>" <?php if($result[0]==$bank1){echo "selected";}?>> <?php echo $result[0]."-".$result[1]; ?> </option>
       <?php 
             }
           }
        ?>
     </select></td>
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">NPWP</td>
   <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input type="text" disabled="disabled" name="npwp" id="npwp" value=""  style="width:200px ;"/></td>
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekening</td>
   <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input type="text" name="rekening" disabled="disabled" id="rekening"  value="" style="width:200px ;" /></td>
 </tr>
  <tr>
       <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekening BUD</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><select name="rek_bud" id="rek_bud" style="width:200px;" >
     <option value="">...Pilih Rekening BUD... </option>
     <option value="402.01.02.00.0277_BANK PAPUA-RKUD">PT. BANK PAPUA-RKUD</option>
     <option value="402.01.02.00.0289_BANK PAPUA-DAK">PT. BAMK PAPUA-DAK</option>
     <option value="402.01.02.00.0291_BANK PAPUA-OTSUS">PT. BANK PAPUA-OTSUS</option>
    
   </td>
 </tr>
 
  <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;</td>
  </tr>
     </table>

    <table id="dg" title=" Detail SPM" style="width:850%;height:250%;" >  
    </table>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>Total</B>&nbsp;&nbsp;<input class="right" type="text" name="rekspm" id="rekspm"  style="width:200px" align="right" readonly="true" >
        <input class="right" type="hidden" name="rekspm1" id="rekspm1"  style="width:100px" align="right" readonly="true" ><br />
        <table id="pot" title="List Potongan" style="width:850px;height:150px;" >  
        </table>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>Total</B>&nbsp;&nbsp;<input class="right" type="text" name="rektotal" id="rektotal"  style="width:200px" align="right" readonly="true" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
    <!-- <?php echo form_close(); ?> -->
	<table border="0">
		<tr>	
		<td colspan="4" align="center" style="border-bottom-color:none;border-spacing: 3px;padding:3px 3px 3px 3px;">
		<a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();">Baru</a>
		<a id="save" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:cekdulu();">Simpan</a>
		<a id="del" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hhapus();">Hapus</a>
		<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:section1();">Kembali</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                
		<a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:cetak();">cetak</a>
		<!-- <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:pajak();">cetak pajak</a>-->
		</td></tr>
	</table>    

   </p>
    </div>
    

   
  
</div>

</div> 

<div id="dialog-modal" title="CETAK SP2D">
    <p class="validateTips">SILAHKAN PILIH SP2D</p> 
    <fieldset>
    <table>
        <tr>
            <td width="110px">NO SP2D:</td>
            <td><input id="csp2d" name="csp2d" style="width: 300px;" /></td>
        </tr>
        <tr>
            <td width="110px">Penandatangan:</td>
            <td><input id="ttd" name="ttd" style="width: 300px;" /></td>
        </tr>
       
    </table>  
    </fieldset>
    <a href="<?php echo site_url(); ?>/tukd/cetak_sp2d" class="easyui-linkbutton" plain="false" onclick="javascript:openWindow(this.href);return false;">Cetak SP2D</a>
    <!--<a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:pajak3();">Cetak Pajak</a>-->
    <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>  
</div>

<div id="dialog-pass" title="Hapus SP2D<br>Silahkan Masukan Username dan Password KABID">  
    <fieldset>
    <form target="_blank" method="POST" id="frm_ctk" >
    <table border="0">
        <tr>
            <td width="30%">Nomor SP2D</td>
            <td width="1%">:</td>
            <td><input type="text" id="nomor18" style="border: 0;" name="nomor18" readonly="true" /></td>
        </tr>
        <tr>
            <td>Jenis SPP</td>
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
            <td><a class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="cek_usr_pass();" >OK</a>               
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>
            </td>
        </tr>
    </table>
    </form>
    </fieldset>
   
</div>
    
</body>

</html>