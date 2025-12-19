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
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <script type="text/javascript">
    
    var kode  = '';
    var giat  = '';
    var jenis = '';
    var nomor = '';
    var cid   = 0;
    var ctk   = '';                      
    
    $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 600,
                width: 700,
                modal: true,
                autoOpen:false                
            });
             $( "#dialog-cetak" ).dialog({
                height: 220,
                width: 300,
                modal: true,
                autoOpen:false                
            });
            
        });    
     
     $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/rka/load_spd',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
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
            {field:'nm_beban',
    		title:'Jenis Beban',
    		width:50,
            align:"center"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor = rowData.no_spd;
          tgl   = rowData.tgl_spd;
          kode  = rowData.kd_skpd;
          nama  = rowData.nm_skpd;
          bulan1= rowData.bulan_awal;
          bulan2= rowData.bulan_akhir;
          jns   = rowData.jns_beban; 
          tot   = number_format(rowData.total,2,'.',',');
          get(nomor,tgl,kode,nama,bulan1,bulan2,jns,tot);  
          load_detail();
          beban();
          jumlah_detail();         
        },
        onDblClickRow:function(rowIndex,rowData){         
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
               bend(kode);               
               $("#nmskpd").attr("value",rowData.nm_skpd);
               $('#giat').combogrid({url:'<?php echo base_url(); ?>index.php/rka/load_trskpd',
                                     queryParams:({kode:kode})
                                     });
           }  
         });


        $('#giat').combogrid({  
           panelWidth:700,  
           idField:'kd_kegiatan',  
           textField:'kd_kegiatan',  
           mode:'remote',                      
           columns:[[  
               {field:'kd_kegiatan',title:'Kode Kegiatan',width:140},  
               {field:'nm_kegiatan',title:'Nama Kegiatan',width:400},
               {field:'lalu',title:'SPD Lalu',width:100,align:'right'},
               {field:'total',title:'Anggaran',width:100,align:'right'}               
           ]],  
           onSelect:function(rowIndex,rowData){
               idxGiat = rowIndex;               
               giat = rowData.kd_kegiatan;
               $("#nmgiat").attr("value",rowData.nm_kegiatan);
               $('#prog').attr("value",rowData.kd_program);
               $('#nmprog').attr("value",rowData.nm_program);
               $('#anggaran').attr("value",number_format(rowData.total,2,'.',','));                
               $("#lalu").attr("value",number_format(rowData.lalu,2,'.',','));
               document.getElementById('nilai').focus();                                                               
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
                {field:'kd_kegiatan', 
        		title:'Kode Kegiatan',
        		width:160},
                {field:'nm_kegiatan',
        		title:'Nama Kegiatan',
        		width:280},
                {field:'nilai',
        		title:'Nilai Rupiah',
        		width:130,
                align:"right"},
                {field:'lalu',
        		title:'Telah Di SPD kan',
        		width:130,
                align:"right"},
                {field:'anggaran',
        		title:'anggaran',
        		width:130,
                align:"right"},
        	    {field:'kd_program',
        		title:'Kode Program',    		
                hidden:"true",	
                width:0},
        	    {field:'nm_program',
        		title:'Nama Program',    		
                hidden:"true",
               	width:0}                
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
                width:35,
                align:"center",
                formatter:function(value,rec){                                                                       
                    return '<img src="<?php echo base_url(); ?>/assets/images/icon/cross.png" onclick="javascript:hapus_detail();" />';                  
                    }                
                },          
                {field:'no_spd',
        		title:'Nomor SPD',    		
                hidden:"true"},                
                {field:'kd_kegiatan',
        		title:'Kode Kegiatan',
        		width:150},
                {field:'nm_kegiatan',
        		title:'Nama Kegiatan',
        		width:300},
                {field:'nilai',
        		title:'Nilai Rupiah',
        		width:130,
                align:"right"},
                {field:'lalu',
        		title:'Telah Di SPD kan',
        		width:130,
                align:"right"},
                {field:'anggaran',
        		title:'anggaran',
        		width:130,
                align:"right"},
        	    {field:'kd_program',
        		title:'Kode Program',    		
                hidden:"true",	
                width:10},
        	    {field:'nm_program',
        		title:'Nama Program',    		
                hidden:"true",
               	width:10}                       
            ]]
        });      
    });        
    
    
    function beban(){
         jenis = document.getElementById('jenis').value; 
         $('#giat').combogrid({
               url:'<?php echo base_url(); ?>index.php/rka/load_trskpd',
               queryParams:({kode:kode,jenis:jenis})
         });
    }
    
    
    function filter_giat(){
        var vgiat = '';
        $('#dg1').edatagrid('selectAll');
        var rows = $('#dg1').edatagrid('getSelections');                   
		for(var i=0;i<rows.length;i++){
			fgiat = "'"+rows[i].kd_kegiatan+"'";
            if (i>0){
                vgiat = vgiat +","+fgiat;
            }else{
                vgiat=fgiat;
            }
            
        }   
        var cno = document.getElementById('nomor').value;                                                          
        $('#dg1').edatagrid('unselectAll');   
        $('#giat').combogrid({  
             url:'<?php echo base_url(); ?>index.php/rka/load_trskpd',
             queryParams:({kode:kode,jenis:jenis,giat:vgiat,no:cno})
        });
    }
    

    /*
    function load_detail(){       
      
       var kk           =  document.getElementById("nomor").value;       
       var ntotal_trans = 0 ;
       
           $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php //echo base_url(); ?>/index.php/rka/load_dspd',
                data: ({no:kk}),
                dataType:"json",
                success:function(data){       
                                beban();    
                                $.each(data,function(i,n){
                                no     = n['no_spd'];                                                                    
                                giat   = n['kd_kegiatan'];
                                nmgiat = n['nm_kegiatan'];
                                prog   = n['kd_program'];
                                nmprog = n['nm_program'];
                                nil    = number_format(n['nilai'],2,'.',',');
                                lal    = number_format(n['lalu'],2,'.',',');
                                ang    = number_format(n['anggaran'],2,'.',','); 
                                xnilai = n['nilai'] ;   
                                
                                ntotal_trans = ntotal_trans + angka(xnilai) ;
                                                                                                                          
                                $('#dg1').edatagrid('appendRow',{no_spd:no,kd_kegiatan:giat,nm_kegiatan:nmgiat,nilai:nil,lalu:lal,anggaran:ang,kd_program:prog,nm_program:nmprog});
                                $('#total1').attr('value',number_format(ntotal_trans,0,'.',','));
                                $('#total').attr('value',number_format(ntotal_trans,0,'.',','));
                                });                                                                           
                }
            });
           });                
           set_grid();     
           $('#dg1').datagrid('reload');                                    
    }
    */
    

    
    /*
    function load_detail(){
        
        var kk = document.getElementById("nomor").value;      
         
        alert(kk); 
         
			$('#dg1').edatagrid({
		    toolbar       : '#toolbar',
            rownumbers    : "true",            
            singleSelect  : "true",
            autoRowHeight : "false",
            nowrap        : "true",
			url: '<?php echo base_url(); ?>/index.php/rka/load_dspd_ar',
            queryParams:({ no:kk }),
            columns:[[                
        	    {field:'no_spd',
        		title:'Nomor SPD',    		
                hidden:"true"},                
                {field:'kd_kegiatan', 
        		title:'Kode Kegiatan',
        		width:160},
                {field:'nm_kegiatan',
        		title:'Nama Kegiatan',
        		width:200},
                {field:'nilai',
        		title:'Nilai Rupiah',
        		width:130,
                align:"right"},
                {field:'lalu',
        		title:'Telah Di SPD kan',
        		width:130,
                align:"right"},
                {field:'anggaran',
        		title:'anggaran',
        		width:130,
                align:"right"},
        	    {field:'kd_program',
        		title:'Kode Program',    		
                hidden:"true",	
                width:0},
        	    {field:'nm_program',
        		title:'Nama Program',    		
                hidden:"true",
               	width:0}                
            ]]
		});
    }
    */


    
    function load_detail(){
        
        var kk = document.getElementById("nomor").value;      

			$('#dg1').edatagrid({
            toolbar:"#toolbar",              
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
			showFooter:true,
			nowrap:false,
			url: '<?php echo base_url(); ?>/index.php/rka/load_dspd_ar',
            queryParams:({ no:kk })
		});
        set_grid();
		$('#dg1').edatagrid('reload');
    
    }
    

    
    function jumlah_detail()
        {
            var kk = document.getElementById("nomor").value;
            
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/jumlah_detail_spd/',
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
                {field:'kd_kegiatan', 
        		title:'Kode Kegiatan',
        		width:160},
                {field:'nm_kegiatan',
        		title:'Nama Kegiatan',
        		width:280},
                {field:'nilai',
        		title:'Nilai Rupiah',
        		width:130,
                align:"right"},
                {field:'lalu',
        		title:'Telah Di SPD kan',
        		width:130,
                align:"right"},
                {field:'anggaran',
        		title:'anggaran',
        		width:130,
                align:"right"},
        	    {field:'kd_program',
        		title:'Kode Program',    		
                hidden:"true",	
                width:0},
        	    {field:'nm_program',
        		title:'Nama Program',    		
                hidden:"true",
               	width:0}                
            ]]
		});
        }
    

    function load_detail2(){        
       $('#dg1').edatagrid('selectAll');
       var rows = $('#dg1').edatagrid('getSelections');             
		for(var p=0;p<rows.length;p++){
		   no = rows[p].no_spd;                                                                    
           giat = rows[p].kd_kegiatan;
           nmgiat = rows[p].nm_kegiatan;
           prog = rows[p].kd_program;
           nmprog = rows[p].nm_program;
           nil = rows[p].nilai;
           lal = rows[p].lalu;
           ang = rows[p].anggaran;                                                                                                                                                                                                                                                                         
           $('#dg2').edatagrid('appendRow',{no_spd:no,kd_kegiatan:giat,nm_kegiatan:nmgiat,nilai:nil,lalu:lal,anggaran:ang,kd_program:prog,nm_program:nmprog});            
        }
        $('#dg1').edatagrid('unselectAll');
    } 
    
    function set_grid(){
        $('#dg1').edatagrid({                                                                   
            columns:[[
               {field:'no_spd',
        		title:'Nomor SPD',    		
                hidden:"true"},                
                {field:'kd_kegiatan',
        		title:'Kode Kegiatan',
        		width:160},
                {field:'nm_kegiatan',
        		title:'Nama Kegiatan',
        		width:280},
                {field:'nilai',
        		title:'Nilai Rupiah',
        		width:130,
                align:"right"},
                {field:'lalu',
        		title:'Telah Di SPD kan',
        		width:130,
                align:"right"},
                {field:'anggaran',
        		title:'anggaran',
        		width:130,
                align:"right"},
        	    {field:'kd_program',
        		title:'Kode Program',    		
                hidden:"true",	
                width:0},
        	    {field:'nm_program',
        		title:'Nama Program',    		
                hidden:"true",
               	width:0}                     
            ]]
        }); 
    }
    
    
    function section1(){
         $(document).ready(function(){    
             $('#section1').click();    
             $('#dg').edatagrid('reload');                                           
         });         
         set_grid();
     }
     
     
     function section2(){
         $(document).ready(function(){                
             $('#section2').click(); 
             document.getElementById("nomor").focus();                                              
         });                 
         set_grid();
     }
       
     
    function get(nomor,tgl,kode,nama,bulan1,bulan2,jns,tot){
        $("#nomor").attr("value",nomor);
        $("#tanggal").datebox("setValue",tgl);
        $("#skpd").combogrid("setValue",kode);
        $("#nmskpd").attr("value",nama);
        $("#bulan1").attr("value",bulan1);
        $("#bulan2").attr("value",bulan2);
        $("#jenis").attr("value",jns);
        $("#total").attr("value",tot);      
    }
    
    function kosong(){
        cdate = '<?php echo date("Y-m-d"); ?>';        
        $("#nomor").attr("value",'');
        $("#tanggal").datebox("setValue",cdate);
        $("#skpd").combogrid("setValue",'');
        $("#nmskpd").attr("value",'');
        $("#bulan1").attr("value",'');
        $("#bulan2").attr("value",'');
        $("#jenis").attr("value",'');
        $("#bendahara").attr("value",'');
        $("#ketentuan").attr("value",'');
        $("#pengajuan").attr("value",'');
        var kode = '';
        var nomor = '';
        $('#giat').combogrid('setValue','');
        $('#nilai').attr('value','0');
        $('#total').attr('value','0');
        
        load_detail_kosong() ;
        document.getElementById("nomor").focus();  
    }
    
    function kosong2(){
        $('#giat').combogrid('setValue','');
        $('#nmgiat').attr('value','');
        $('#anggaran').attr('value','0');
        $('#lalu').attr('value','0');
        $('#nilai').attr('value','0');                
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
    

    function validate1(){

        var jenis = document.getElementById('jenis').value; 
        var bln1  = document.getElementById('bulan1').value;
		var kode  = $('#skpd').combogrid('getValue');
        var cno   = document.getElementById('nomor').value;
		$("#bulan2").attr("value",bln1);


            $(function(){
			$('#dg1').edatagrid({
				 url: '<?php echo base_url(); ?>/index.php/rka/load_dspd_all_keg/'+jenis+'/'+kode+'/'+bln1+'/'+bln1+'/'+cno,
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:"true",
                 singleSelect:"true",
				 showFooter:true,
				 nowrap:false
			});
			});		
			set_grid();
			$('#dg1').edatagrid('reload');
    }
    
    
    function validate2(){
        var jenis = document.getElementById('jenis').value; 
        var bln1  = document.getElementById('bulan1').value;
        var bln2  = document.getElementById('bulan2').value;
		var kode  = $('#skpd').combogrid('getValue');
        var cno   = document.getElementById('nomor').value;

		if (bln2 < bln1){
            alert('Bulan Sampai dengan tidak bisa lebih kecil dari Bulan awal');
            $("#bulan2").attr("value",bln1);   
			bln2=bln1;
		}

            $(function(){
			$('#dg1').edatagrid({
				 url: '<?php echo base_url(); ?>/index.php/rka/load_dspd_all_keg/'+jenis +'/'+kode+'/'+bln1+'/'+bln2+'/'+cno,
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:"true",
                 singleSelect:"true",
				 showFooter:true,
				 nowrap:false
			});
			});		
			set_grid();
            get_total();
			$('#dg1').edatagrid('reload');
	}
    

     function get_total()
        {
            var bln1 = document.getElementById('bulan1').value;
            var bln2 = document.getElementById('bulan2').value;
    		var kode = $('#skpd').combogrid('getValue');
            var jenis = document.getElementById('jenis').value; 

        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/total_spd_ar/'+jenis+'/'+kode+'/'+bln1+'/'+bln2,
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#total").attr("value",number_format(data.total,0,'.',','));
        							  }                                     
        	});
        } 

    
    function append_save(){        
        var nomor = document.getElementById('nomor').value;
        var nama = document.getElementById('nmgiat').value;
        var namaprog = document.getElementById('nmprog').value;
        var kdprog = document.getElementById('prog').value;
        var nil = angka(document.getElementById('nilai').value);
        var ang = angka(document.getElementById('anggaran').value);
        var lal = angka(document.getElementById('lalu').value);
        var tot1 = angka(document.getElementById('total').value);        
        var giat = $('#giat').combogrid('getValue');        
        var tot2 = 0; 
        
        sisa_spd();
                                    
        if (giat != '' && nil != 0 && ang != 0) {                                              
            tot2 = tot1 + nil;
            nil = number_format(nil,2,'.',',');
            lal = number_format(lal,2,'.',',');
            ang = number_format(ang,2,'.',',');
            $('#dg1').datagrid('appendRow',{no_spd:nomor,kd_kegiatan:giat,nm_kegiatan:nama,nilai:nil,anggaran:ang,lalu:lal,kd_program:kdprog,nm_program:namaprog});
            $('#dg2').datagrid('appendRow',{no_spd:nomor,kd_kegiatan:giat,nm_kegiatan:nama,nilai:nil,anggaran:ang,lalu:lal,kd_program:kdprog,nm_program:namaprog});              
            $('#total').attr('value',number_format(tot2,2,'.',','));                          
            $('#total1').attr('value',number_format(tot2,2,'.',','));      
            filter_giat();
            kosong2(); 
        } 
                                
    }     
    
    function cetak(){
        var nomor = document.getElementById('nomor').value;
        $("#dialog-cetak").dialog('open');
        $('#nomor1').attr('value',nomor);
    }                 
    
    function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            urll ='<?php echo base_url(); ?>index.php/rka/cetak_lampiran_spd1';
        } else if (ctk=='2'){
            urll ='<?php echo base_url(); ?>index.php/rka/cetak_otor_spd';
        } else {
            exit();
        }          
        $('#frm_ctk').attr('action',urll);                        
    }      
     
    function submit(){
        if (ctk==''){
            alert('Pilih Jenis Cetakan');
            exit();
        }
        document.getElementById("frm_ctk").submit();    
    }
    
    function tambah(){
        var kd = $('#skpd').combogrid('getValue');
        var tgl = $('#tanggal').datebox('getValue');
        var total = document.getElementById('total').value;
        $('#dg2').edatagrid('reload');
        if (kd != '' && tgl != ''){             
            filter_giat();
            kosong2();
            $("#dialog-modal").dialog('open');
            $('#total1').attr('value',total);
            load_detail2();
        } else {
            alert('Harap Isi Kode SKPD dan Tanggal SPD') ;         
        }
    }
    
    function keluar(){
        $("#dialog-modal").dialog('close');
        $("#dialog-cetak").dialog('close');
       kosong2();
    }    
    
    function hapus_giat(){
         tot3 = 0;
         var tot = angka(document.getElementById('total').value);
         tot3 = tot - nilx;
         $('#total').attr('value',number_format(tot3),2,'.',',');        
         $('#dg1').datagrid('deleteRow',idx);     
    }
    
    function hapus_detail(){
        var rows = $('#dg2').edatagrid('getSelected');
        cgiat = rows.kd_kegiatan;        
        cnil = rows.nilai;
        var idx = $('#dg2').edatagrid('getRowIndex',rows);
        var tny = confirm('Yakin Ingin Menghapus Data, Kegiatan : '+cgiat+' ,Nilai : '+cnil);
        if (tny==true){
            $('#dg2').edatagrid('deleteRow',idx);
            $('#dg1').edatagrid('deleteRow',idx);
            total = angka(document.getElementById('total1').value) - angka(cnil);            
            $('#total1').attr('value',number_format(total,2,'.',','));    
            $('#total').attr('value',number_format(total,2,'.',','));
            kosong2();
        } 
        
    }
    
    function hapus(){
        var cnomor = document.getElementById('nomor').value;
        var urll = '<?php echo base_url(); ?>index.php/rka/hapus_spd';
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor SPD : '+cnomor);
        if (tny==true){
        $(document).ready(function(){
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({no:cnomor}),
                 success:function(data){
                        status = data.pesan;
                        if (status=='1'){
                            alert('Data Berhasil Terhapus...!!!');   
                            $('#dg').edatagrid('reload');      
                        } else {
                            alert('Gagal Hapus...!!!');
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
        var cbend = document.getElementById('bendahara').value;
        var cbln1 = document.getElementById('bulan1').value;
        var cbln2 = document.getElementById('bulan2').value;
        var cketentuan = document.getElementById('ketentuan').value;
        var cpengajuan = document.getElementById('pengajuan').value;
        var cjenis = document.getElementById('jenis').value;
        var ctotal = angka(document.getElementById('total').value);
        
        if (cno==''){
            alert('Nomor SPD Tidak Boleh Kosong');
            exit();
        } 
        if (ctgl==''){
            alert('Tanggal SPD Tidak Boleh Kosong');
            exit();
        }
        if (cskpd==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        }
        
        $(document).ready(function(){
            $.ajax({
                type: "POST",    
                dataType:'json',                            
                data: ({tabel:'trhspd',no:cno,tgl:ctgl,skpd:cskpd,nmskpd:cnmskpd,bend:cbend,bln1:cbln1,bln2:cbln2,ketentuan:cketentuan,pengajuan:cpengajuan,jenis:cjenis,total:ctotal}),
                url: '<?php echo base_url(); ?>/index.php/rka/simpan_spd',
                success:function(data){
                    status = data.pesan;                    
                }
            });
        });
        
        if (status=='0'){
            alert('Gagal Simpan...!!');
            exit();
        }
        
        if (status !='0'){
            $('#dg1').datagrid('selectAll');
            var rows = $('#dg1').datagrid('getSelections');           
			for(var p=0;p<rows.length;p++){
				cnospd   = cno;
                ckdgiat  = rows[p].kd_kegiatan;
                cnmgiat  = rows[p].nm_kegiatan;
                ckdprog  = rows[p].kd_program;
                cnmprog  = rows[p].nm_program;
                cnilai   = angka(rows[p].nilai);                 
                if (p>0) {
                    csql = csql+","+"('"+cnospd+"','"+ckdgiat+"','"+cnmgiat+"','"+ckdprog+"','"+cnmprog+"','"+cnilai+"')";
                } else {
                    csql = "values('"+cnospd+"','"+ckdgiat+"','"+cnmgiat+"','"+ckdprog+"','"+cnmprog+"','"+cnilai+"')";                                            
                }                                             
			}

			 $(document).ready(function(){
                $.ajax({
                    type: "POST",    
                    dataType:'json',                    
                    data: ({tabel:'trdspd',no:cno,sql:csql}),
                    url: '<?php echo base_url(); ?>/index.php/rka/simpan_spd',
                    success:function(data){
                        status = data.pesan;
                   if (status=='1'){               
                        alert('Data Berhasil Tersimpan...!!!');
                    } else{ 
                        alert('Data Gagal Tersimpan...!!!');
                    }                                              
                    }                                        
                });
            });                        
        }  
    }
    
    
    function spdlalu(cgiat){
        var dgiat = cgiat; 
        var dtgl = $('#tanggal').datebox('getValue');    
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/rka/spd_lalu',
                data: ({cgiat:dgiat,ctgl:dtgl}), 
                dataType:"json",              
                success:function(data){
                    $.each(data, function(i,n){
                        cspdLalu = number_format(n['lalu'],2,'.',',');
                        $("#lalu").attr("value",cspdLalu);
                   });
                }
            });
        });
                
    }
    
    function sisa_spd(){
        var ang = angka(document.getElementById('anggaran').value);
        var lalu = angka(document.getElementById('lalu').value);
        var nil = angka(document.getElementById('nilai').value)  ;
        
        sisa = ang - lalu;
        slalu = (sisa - nil);    
        if (slalu < 0){
                alert('Nilai Melebihi SPD Lalu');
                exit();                
        }
    }


    function tes(){
        urrl= '<?php echo base_url(); ?>/index.php/rka/sql_tes'
       $(document).ready(function(){
            $.post(urrl,({no:'1'}),function(data){
                status=data;
                if (status =='1'){
                    alert('ok');
                }else{
                    alert(status);
                }
            });
        });
    }
    
    
    function bend(c){                
        $(function(){      
         $.ajax({
            type: 'POST',
            data:({skpd:c}),
            url:"<?php echo base_url(); ?>index.php/rka/load_bendahara_p",
            dataType:"json",
            success:function(data){ 
                $.each(data, function(i,n){
                    $("#bendahara").attr("value",n['nama']);
                });
            }
         });
        });
    }
                         
    </script>

</head>
<body>



<div id="content">    
<div id="accordion">
<h3><a href="#" id="section1">List SPD</a></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();section2();">Tambah</a>               
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="dg" title="List SPD" style="width:870px;height:450px;" >  
        </table>                          
    </p> 
    </div>   

<h3><a href="#" id="section2">S P D</a></h3>
   <div  style="height: 350px;">
   <p>       
        <table align="center" border='1' style="width:870px;">
        
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td colspan="5" style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;</td>
            </tr>                        


            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">No. S P D</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="nomor" style="width: 180px;" onclick="javascript:select();"/></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"></td>
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
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;"><?php echo $this->rka_model->combo_bulan('bulan1','onchange="javascript:validate1();"'); ?> s/d <?php echo $this->rka_model->combo_bulan('bulan2','onchange="javascript:validate2();"'); ?></td>
            </tr>                        
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Ketentuan Lain</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="ketentuan"/></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Jenis Pengajuan</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">&nbsp;<input type="text" id="pengajuan"/></td>
            </tr>            
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Bendahara</td>
                <td colspan='5' style="border-bottom-style:hidden;padding:5px;border-spacing:5px 5px 5px 5px;">&nbsp;<input type="text" id="bendahara"/></td>
                
            </tr>
            <tr style="padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="padding:3px;border-spacing:5px 5px 5px 5px;border-bottom-style:hidden;" colspan="5" align="right"><a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a>
                    <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_spd();">Simpan</a>
		            <a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();section1();">Hapus</a>
                    <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">Cetak</a>
  		            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section1();">Kembali</a>                                   
                </td>
            </tr>
            
            <tr style=";padding:3px;border-spacing:5px 5px 5px 5px;">
                <td colspan="5" style="padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;border-bottom-color:black;">&nbsp;</td>
            </tr>                        

            
        </table>          
        
        <table id="dg1" title="Kegiatan S P D" style="width:870px;height:350px;" >  
        </table>  
        
        <div id="toolbar" align="right">

    		<!--<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah();">Tambah Kegiatan</a>
   		    <input type="checkbox" id="semua" value="1" /><a onclick="">Semua Kegiatan</a>
            <a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus_giat();">Hapus Kegiatan</a>-->
               		
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
                
   </p>
   </div>
   
</div>
</div>


<div id="dialog-modal" title="Input Kegiatan">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
    <table>
        <tr>
            <td width="15px">Kode Kegiatan</td>
            <td>:</td>
            <td><input id="giat" name="giat" style="width: 200px;" /></td>
        </tr>
        <tr>
            <td width="15px">Nama Kegiatan</td>
            <td>:</td>
            <td><input type="text" id="nmgiat" readonly="true" style="border:0;width: 400px;"/></td>
            <td><input type="hidden" id="prog" readonly="true" style="border:0;width: 400px;"/></td>
            <td><input type="hidden" id="nmprog" readonly="true" style="border:0;width: 400px;"/></td>
        </tr>
        <tr> 
           <td width="15px">Anggaran</td>
           <td>:</td>
           <td><input type="text" id="anggaran" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/></td>
        </tr>
        <tr> 
           <td width="15px">Yang Telah di SPD kan</td> <!--bukan Lalu, tapi yang sudah di SPDkan untuk Kontrol biat tidak melebihi anggaran saat edit yang lalu-->
           <td>:</td>
           <td><input type="text" id="lalu" style="text-align: right;" readonly="true" style="border:0;width: 400px;"/></td>
        </tr>
        <tr> 
           <td width="15px">Nilai</td>
           <td>:</td>
           <td><input type="text" id="nilai" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))" onkeyup="javascript:sisa_spd();" /></td>
        </tr>
    </table>  
    </fieldset>
    <fieldset>
    <table align="center">
        <tr>
            <td><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_save();">Simpan</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>
            </td>
        </tr>
    </table>
    </fieldset>
    <fieldset>
    <div  align="right">Total : <input type="text" id="total1" style="font-size: large;border:0;width: 200px;text-align: right;" readonly="true"/></div>
     <table id="dg2" title="Kegiatan S P D" style="width:650px;height:250px;" >  
        </table>  
    </fieldset>  
</div>

<div id="dialog-cetak" title="Cetak SPD">
    <p class="validateTips">Cetak</p>     
    <fieldset>
   	<form target="_blank" method="POST" id="frm_ctk" >
    <table>
        <tr>
            <td>Nomor SPD</td>
            <td>:</td>
            <td><input type="text" id="nomor1" style="border: 0;" name="nomor1" readonly="true" /></td>
        </tr>
        <tr><td colspan="3"><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />Lampiran SPD</td></tr>
        <tr><td colspan="3"><input type="radio" name="cetak" value="2" onclick="opt(this.value)" />Otorisasi SPD</td></tr>
    </table>
    </fieldset>
    <fieldset>
    <table align="center">
        <tr>
            <td><a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="submit()" >Print</a>               
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>
            </td>
        </tr>
    </table>
    </form>
    </fieldset>
   
</div>

</body>

</html>