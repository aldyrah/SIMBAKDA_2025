
<script type="text/javascript">
var cgol ='';
var lpnodok1 = '';
updt = 'f';
total_updt=0;
$(document).ready(function() {
    $("#tabs").tabs();
    $("#dialog-modal").dialog({
        height: 700,
        width: 800,
        modal: true, 
        background:'#2da305',           
        autoOpen:false                
    });
    $("#dialog-modal_bap").dialog({
        height: 650,
        width: 800,
        modal: true, 
        background:'#2da305',           
        autoOpen:false                
    });              
    set_grid();
});    

$(function(){ 
    $('#trh').edatagrid({
        url: "<?php echo base_url(); ?>index.php/simpl/ambil_plh_form_isian",
        idField:'no_dokumen',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
				{field:'no_transaksi',title:'No. Trans',width:20,align:"center"},
                {field:'kegiatan',title:'Kode Kegiatan',width:30,align:"center"},
                {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,align:"center"},
                {field:'rekanan',title:'Rekanan',width:50,align:"center"},
				{field:'pptk',title:'PPTK',width:30,align:"center"}         
        ]],
        onSelect:function(rowIndex,rowData){
				no_transaksi   = rowData.no_transaksi;
				kd_skpd   	   = rowData.kd_skpd;
                kegiatan       = rowData.kegiatan;
                nm_kegiatan    = rowData.nm_kegiatan;
				keterangan	   = rowData.keterangan;
				pptk	       = rowData.pptk;
                rekanan	       = rowData.rekanan;
                staf_penerima  = rowData.staf_penerima;
				ketua	       = rowData.ketua;
				anggota_satu   = rowData.anggota_satu;
				anggota_dua	   = rowData.anggota_dua;
                total          = rowData.total;
                get(no_transaksi,kd_skpd,kegiatan,nm_kegiatan,keterangan,pptk,rekanan,staf_penerima,ketua,anggota_satu,anggota_dua,total);         
                   
        },
        onDblClickRow:function(rowIndex,rowData){  
            loadDetail();     
            tab2();                              
        }
    });    
       
    $('#trd').edatagrid({                
        toolbar:'#toolbar',           
        rownumbers:"true",         
        singleSelect:"true",        
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",        
        nowrap:"true",
        onSelect:function(rowIndex,rowData){
            idx2 = rowIndex;                        
            var no      = rowData.no_dokumen;  
            var cjns    = rowData.jns;   
            var cnmjns  = rowData.nm_golongan;                                         
            var kdbrg   = rowData.kd_brg;
            var nmbrg   = rowData.nm_brg;
            var sdana   = rowData.s_dana;
            var nosp2d  = rowData.no_sp2d;
            var tglsp2d = rowData.tgl_sp2d;
            var nilsp2d = rowData.nilai_sp2d;
            var nilkont = rowData.nilai_kontrak;
            var kdgiat  = rowData.kd_kegiatan;
            var kdrek5  = rowData.kd_rek5;
            var jml     = rowData.jumlah;
            var hrg     = rowData.harga;
            var cppn    = rowData.ppn;
            var tot     = rowData.total;
            var ket     = rowData.keterangan;
            var invt    = rowData.invent;            
            getDetail(no,cjns,cnmjns,kdbrg,nmbrg,sdana,nosp2d,tglsp2d,nilsp2d,nilkont,kdgiat,kdrek5,jml,hrg,cppn,tot,ket,invt);                 
           // alert(no+'-'+cjns+'-'+kdbrg);
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
    $('#dstgl').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return y+'-'+m+'-'+d;
        }
    });
    
     $('#tgl_kontrak_bap').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return d+'-'+m+'-'+y;
        }
    });
    
     $('#tgl_kep').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return d+'-'+m+'-'+y;
        }
    });
    
     $('#tgl_bap').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return d+'-'+m+'-'+y;
        }
    });
    
     $('#tgl_ctk_bap').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return d+'-'+m+'-'+y;
        }
    });
    
    
    $('#compy').combobox({           
        valueField:'kd_comp',  
        textField:'nm_comp',
        mode:'remote',
        width:300,
        url:'<?php echo base_url(); ?>index.php/master/ambil_compy'
    });        
    $('#milik').combobox({           
        valueField:'kd_milik',  
        textField:'nm_milik',
        mode:'remote',
        width:300,
        url:'<?php echo base_url(); ?>index.php/master/ambil_milik'
    });
    $('#wilayah').combobox({           
        valueField:'kd_wilayah',  
        textField:'nm_wilayah',
        mode:'remote',
        width:300,
        url:'<?php echo base_url(); ?>index.php/master/ambil_wilayah'
    });
    $('#unit').combobox({           
        valueField:'kd_uskpd',  
        textField:'nm_uskpd',
        mode:'remote',
        width:300,
        url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',
        onSelect:function(rec){                        
            kuskpd = rec.kd_uskpd ;
            $('#nmunit').attr('value',rec.nm_uskpd); 
        }
    });
    
    
    $('#dana').combobox({           
        valueField:'kode',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'APBN'},{kode:'2',nama:'APBD'},{kode:'3',nama:'BLN'},{kode:'4',nama:'INPRES'},
        {kode:'5',nama:'BANPRES'},{kode:'6',nama:'BPP'},{kode:'7',nama:'NON BUDGETER'},{kode:'8',nama:'LAIN-LAIN'}]
    });
    $('#tahun').combobox({           
        valueField:'tahun',  
        textField:'tahun',
        mode:'remote',
        width:70,
        url:'<?php echo base_url(); ?>index.php/master/tahun'
    });
    $('#thn2').combobox({           
        valueField:'tahun',  
        textField:'tahun',
        mode:'remote',
        width:70,
        url:'<?php echo base_url(); ?>index.php/master/tahun'
    });
    $('#bukti').combobox({           
        valueField:'kode',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'SPMU'},{kode:'2',nama:'SPM'},{kode:'3',nama:'BUKTI SETORAN'},{kode:'4',nama:'SP2D'}]
    });
    

    $('#jabat_awas1').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    
    $('#jabat_awas2').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas3').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas4').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas5').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas6').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas7').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    
    $('#hari').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:75,
        data:[{kode:'1',nama:'Minggu'},{kode:'2',nama:'Senin'},{kode:'3',nama:'Selasa'},
        {kode:'4',nama:'Rabu'},{kode:'5',nama:'Kamis'},{kode:'6',nama:'Jumat'},{kode:'7',nama:'Sabtu'}]
    });
    
    $('#bln_bap').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:100,
        data:[{kode:'1',nama:'Januari'},{kode:'2',nama:'Februari'},{kode:'3',nama:'Maret'},
        {kode:'4',nama:'April'},{kode:'5',nama:'Mei'},{kode:'6',nama:'Juni'},
        {kode:'7',nama:'Juli'},{kode:'8',nama:'Agustus'},{kode:'9',nama:'September'},{kode:'10',nama:'Oktober'},
        {kode:'11',nama:'November'},{kode:'12',nama:'Desember'}]
    });
    
    
     
    $('#perolehan').combobox({           
        valueField:'kd_cr_oleh',  
        textField:'cara_perolehan',
        mode:'remote',
        width:150,
        url:'<?php echo base_url(); ?>index.php/master/perolehan'                    
    });
    
     $('#pengawas1').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas7').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas2').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas3').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas4').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas5').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas6').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     
    
    $('#dasar').combobox({           
        valueField:'kode',  
        textField:'nama',        
        width:150,
        data:[{kode:'0',nama:'Tidak Tau'},{kode:'1',nama:'SKO'},{kode:'2',nama:'BERITA ACARA'},{kode:'3',nama:'SERTIFIKAT'}]
    });    
    $('#cmbjenis').combobox({           
        valueField:'golongan',  
        textField:'nm_golongan',
        mode:'remote',
        width:160,
        url:'<?php echo base_url(); ?>index.php/master/ambil_gol',
        onSelect:function(rec){
            cgol=rec.golongan;
            $('#cmbidang').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bidang',
            queryParams:({gol:cgol})});            
        }                    
    });

	 $('#cmbidang').combogrid({  
            panelWidth:600, 
            width:160, 
            idField:'bidang',  
            textField:'nm_bidang',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'bidang',title:'Kode Barang',width:100},  
               {field:'nm_bidang',title:'Nama Barang',width:500}    
            ]],  
             onSelect:function(rowIndex,rowData){
				cbidang=rowData.bidang;
				$('#cmkel').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_kelompok',
				queryParams:({bidang:cbidang})});            
        }  
    });
	
	 $('#cmkel').combogrid({  
            panelWidth:600, 
            width:160, 
            idField:'kelompok',  
            textField:'nm_kelompok',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kelompok',title:'Kode Barang',width:100},  
               {field:'nm_kelompok',title:'Nama Barang',width:500}    
            ]],  
             onSelect:function(rowIndex,rowData){
				ckelompok=rowData.kelompok;
				$('#cmsubkel').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_kelompok1',
				queryParams:({kelompok:ckelompok})});            
        }  
    });
	
    $('#cmsubkel').combogrid({  
            panelWidth:600, 
            width:160, 
            idField:'kd_kelompok',  
            textField:'nm_kelompok',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_kelompok',title:'Kode Barang',width:100},  
               {field:'nm_kelompok',title:'Nama Barang',width:500}    
            ]],  
             onSelect:function(rowIndex,rowData){
				csubkel=rowData.kd_kelompok;
				$('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/master/load_brg',
				queryParams:({subkel:csubkel})});             
        }  
    });
	
    $('#kdbrg').combogrid({  
            panelWidth:600, 
            width:160, 
            idField:'kd_brg',  
            textField:'nm_brg',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Barang',width:100},  
               {field:'nm_brg',title:'Nama Barang',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nm_brg;              
                $('#nmbrg').attr('value',cnm);                
            } 
    }); 
    $('#sbrdana').combobox({           
        valueField:'kd_sumberdana',  
        textField:'nm_sumberdana',
        mode:'remote',
        width:145,
        url:'<?php echo base_url(); ?>index.php/master/ambil_dana'                    
    });
    $('#tglsp2d').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return y+'-'+m+'-'+d;
        }
    });    
});    

function tab1(){
    $('#tabs1').click();
    //$('#trh').edatagrid('reload');      
}
function tab2(){
   $('#tabs2').click()
  }

function kosong(){
    $(":text").attr('value','');    
    $("#trd").edatagrid('reload');
}
function kosong2(){    
    $("#dialog-modal :text").attr("value","");
    $("#dialog-modal :checkbox").attr("checked",false);
    $("#ket").attr("value","");
    updt = 'f';
}
function getData(no,tgl,nilkon,nilapbd,kdcomp,kdmilik,kdwilayah,kduskpd,jnsdana,tahunang,buktibyr,dasaroleh,nooleh,tgloleh,tahunoleh,tot,cr_oleh,pnkrg)
{
    kosong();
    //alert(no);
    //pcnodok1 = no;
    //txtnodok_h
    $('#txtnodok_h').attr('value',no);
    $('#nomor').attr('value',no);
    $('#tanggal').datebox('setValue',tgl);
    $('#nilkont').attr('value',nilkon);
    $('#nilapbd').attr('value',nilapbd);
    $('#compy').combobox('setValue',kdcomp);
    $('#milik').combobox('setValue',kdmilik);
    $('#wilayah').combobox('setValue',kdwilayah);
    $('#unit').combobox('setValue',kduskpd);
    $('#dana').combobox('setValue',jnsdana);
    $('#tahun').combobox('setValue',tahunang);
    $('#bukti').combobox('setValue',buktibyr);
    $('#dasar').combobox('setValue',dasaroleh);
    $('#dsno').attr('value',nooleh);
    $('#dstgl').datebox('setValue',tgloleh);
    $('#thn2').combobox('setValue',tahunoleh);    
    $('#total').attr('value',number_format(tot,2,'.',','));
    $('#perolehan').combobox('setValue',cr_oleh);
    $('#krg').attr('value',number_format(pnkrg,2,'.',','));   
      
}




function getDetail(no,cjns,cbdg,cnmjns,kdbrg,nmbrg,sdana,nosp2d,tglsp2d,nilsp2d,nilkont,kdgiat,kdrek5,jml,hrg,cppn,tot,ket,invt)
{
    kosong2();
    updt = 't';
    $("#cmbjenis").combobox("setValue",cjns);
    $("#cmbidang").combobox("setValue",cbdg);
	$("#cmkel").combobox("setValue",ckel);
    $("#cmsubkel").combobox("setValue",csubkel);
    $("#kdbrg").combogrid("setValue",kdbrg);
    $("#nmbrg").attr("value",nmbrg);
    $("#sbrdana").combobox("setValue",sdana);
    $("#nosp2d").attr("value",nosp2d);
    $("#tglsp2d").datebox("setValue",tglsp2d);
    $("#nilsp2d").attr("value",nilsp2d);
    $("#nilkon1").attr("value",nilkont);
    $("#kegiatan").attr("value",kdgiat);
    $("#rekening").attr("value",kdrek5);
    $("#jumlah").attr("value",jml);
    $("#harga").attr("value",hrg);
    $("#nilppn").attr("value",cppn);
    if (angka(cppn)==0){
        $("#ppn").attr("checked",false);
    }else{
        $("#ppn").attr("checked",true);
    }
    $("#total2").attr("value",tot);
    total_updt = tot;
    $("#ket").attr("value",ket);    
    hitung();    
    tambah_detail();
}
function loadDetail(){
    var i = 0;
    var nomor = document.getElementById('nomor').value;                     
    $.ajax({
        type: "POST",
        url: '<?php echo base_url(); ?>index.php/transaksi/trd_isianbrg',
        data: ({no:nomor}),
        dataType:"json",
        success:function(data){                                          
            $.each(data,function(i,n){                                    
                no      = n['no_dokumen'];  
                cjns    = n['jns'];   
                cnmjns  = n['nm_golongan'];                                         
                kdbrg   = n['kd_brg'];
                nmbrg   = n['nm_brg'];
                sdana   = n['s_dana'];
                nosp2d  = n['no_sp2d'];
                tglsp2d = n['tgl_sp2d'];
                nilsp2d = n['nilai_sp2d'];
                nilkont = n['nilai_kontrak'];
                kdgiat  = n['kd_kegiatan'];
                kdrek5  = n['kd_rek5'];
                jml     = number_format(n['jumlah'],2,'.',',');
                hrg     = number_format(n['harga'],2,'.',',');
                cppn    = number_format(n['ppn'],2,'.',',');
                tot     = number_format(n['total'],2,'.',',');
                ket     = n['keterangan'];
                invt    = n['invent'];
                if(invt=='1'){
                    invt = 'Ya'
                } else {
                    invt = 'Tidak'
                }
                $('#trd').datagrid('appendRow',{no_dokumen:no,jns:cjns,nm_golongan:cnmjns,kd_brg:kdbrg,nm_brg:nmbrg,s_dana:sdana,no_sp2d:nosp2d,tgl_sp2d:tglsp2d,
                nilai_sp2d:nilsp2d,nilai_kontrak:nilkont,kd_kegiatan:kdgiat,kd_rek5:kdrek5,jumlah:jml,harga:hrg,ppn:cppn,total:tot,
                keterangan:ket,invent:invt});                                
            });
        }
    });         
    set_grid();
        
}

function set_grid(){
    $('#trd').edatagrid({
        columns:[[   	                          
            {field:'nm_golongan',title:'Jenis',width:100},            
            {field:'kd_brg',title:'Kode Barang',width:100},
            {field:'nm_brg',title:'Nama Barang',width:200},            
            {field:'no_sp2d',title:'No.SP2D',width:150},
            {field:'tgl_sp2d',title:'Tanggal SP2D',width:100},   
            {field:'jumlah',title:'Unit',width:50,align:'right'},
            {field:'harga',title:'Harga/Unit',width:150,align:'right'},    
            {field:'ppn',title:'PPN',width:150,align:'right'},
            {field:'total',title:'Total',width:150,align:'right'},
            {field:'invent',title:'Inventaris',width:50},
            {field:'no_dokumen',title:'nomor',width:50,hidden:true},
            {field:'jns',title:'jenis',width:50,hidden:true},
            {field:'s_dana',title:'Sumber Dana',width:50,hidden:true},
            {field:'nilai_sp2d',title:'Nilai Sp2d',width:50,hidden:true},
            {field:'nilai_kontrak',title:'Nilai Kontrak',width:50,hidden:true},
            {field:'kd_kegiatan',title:'Kegiatan',width:50,hidden:true},
            {field:'kd_rek5',title:'Rekening',width:50,hidden:true},
            {field:'keterangan',title:'Keterangan',width:50,hidden:true}                                                                               
        ]]
    });
}

function hitung(){
    jml = angka(document.getElementById('jumlah').value);
    hrg = angka(document.getElementById('harga').value);
    chk = document.getElementById('ppn').checked;
    total = jml * hrg ;    
    if (chk==true){
        totppn = total * 10/100;
        tothrg = total + totppn;        
    } else {
        totppn = 0;
        tothrg = total;
    }
    total = number_format(total,2,'.',',');
    $('#total1').attr('value',total);        
    totppn = number_format(totppn,2,'.',',');
    $('#nilppn').attr('value',totppn);
    tothrg = number_format(tothrg,2,'.',',');
    $('#total2').attr('value',tothrg);
}

function append_save()
{
    no      = document.getElementById('nomor').value;    
    cjns    = $('#cmbjenis').combobox('getValue');  
    cbdg    = $('#cmbidang').combobox('getValue');   
    ckel    = $('#cmkel').combobox('getValue');    	
    csubkel = $('#cmsubkel').combobox('getValue');    	 	
    cnmjns  = $('#cmbjenis').combobox('getText');
    kdbrg   = $('#kdbrg').combogrid('getValue');
    nmbrg   = document.getElementById('nmbrg').value;    
    sdana   = $('#sbrdana').combobox('getValue');
    nosp2d  = document.getElementById('nosp2d').value;
    tglsp2d = $('#tglsp2d').datebox('getValue');    
    nilsp2d = document.getElementById('nilsp2d').value;
    nilkont = document.getElementById('nilkon1').value;    
    kdgiat  = document.getElementById('kegiatan').value;
    kdrek5  = document.getElementById('rekening').value;    
    jml     = document.getElementById('jumlah').value;
    hrg     = document.getElementById('harga').value;    
    tot1    = document.getElementById('total1').value;
    cppn    = document.getElementById('nilppn').value;    
    tot     = document.getElementById('total2').value;
    ket     = document.getElementById('ket').value;    
    total   = angka(document.getElementById('total').value);
    invt    = '';        
    if (cjns != '' && kdbrg != '' && sdana != '' && tot != '' ){       
        if (updt == 'f') {
            $('#trd').datagrid('appendRow',{no_dokumen:no,jns:cjns,nm_golongan:cnmjns,kd_brg:kdbrg,nm_brg:nmbrg,s_dana:sdana,no_sp2d:nosp2d,tgl_sp2d:tglsp2d,
                nilai_sp2d:nilsp2d,nilai_kontrak:nilkont,kd_kegiatan:kdgiat,kd_rek5:kdrek5,jumlah:jml,harga:hrg,ppn:cppn,total:tot,
                keterangan:ket,invent:invt});                                                  
            a = total + angka(tot);                
        } else if (updt=='t'){
            $('#trd').datagrid('updateRow',{index:idx2,row:{no_dokumen:no,jns:cjns,nm_golongan:cnmjns,kd_brg:kdbrg,nm_brg:nmbrg,s_dana:sdana,no_sp2d:nosp2d,tgl_sp2d:tglsp2d,
                nilai_sp2d:nilsp2d,nilai_kontrak:nilkont,kd_kegiatan:kdgiat,kd_rek5:kdrek5,jumlah:jml,harga:hrg,ppn:cppn,total:tot,
                keterangan:ket,invent:invt}});                                                                                                 
            s = total - angka(total_updt);
            a = s + angka(tot);
        }
        updt = 't';
        total = number_format(a,2,'.',',');
        $('#total').attr('value',total);
        lnkrg = angka(document.getElementById('nilkont').value) - angka(document.getElementById('total').value) 
        $('#krg').attr('value',number_format(lnkrg,2,'.',','));                                         
        
        kosong2();
        alert('Data Tersimpan');
    } else {
            alert('Jenis, Kode, Jumlah dan Harga tidak boleh kosong');
            exit();
    }           
}
function hapus(){
        //var cnomor = lpnodok1;
        //alert(lpnodok1);
        //var cnomor = document.getElementById('nomor').value;
        var cnomor = document.getElementById('txtnodok_h').value;// txtnodok_h
        //alert(cnomor);
        
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_isianbrg';
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor Dokumen : '+cnomor);        
        //lc = cek_nodok()
        if (tny==true){
            $(document).ready(function(){
            $.ajax({url:urll,
                     dataType:'json',
                     type: "POST",    
                     data:({no:cnomor}),
                     success:function(data){
                            status = data.pesan;
                            if (status=='1'){
                                alert('Data Berhasil Terhapus');
                                kosong();
                                $('#trh').edatagrid('reload');         
                            } else {
                                alert('Gagal Hapus');
                            }        
                     }
                     
                    });           
            });
        }     
    }
function hapus_detail(){
    var rows = $('#trd').datagrid('getSelected');
    ckd =   rows.kd_brg;
    cnm =   rows.nm_brg;
    ctot =   rows.total;                                   
    var idx = $('#trd').datagrid('getRowIndex',rows);
    var tny = confirm('Yakin Ingin Menghapus Data, Kode Barang : '+ckd+' Nama Barang : '+cnm+' Nilai : '+ctot);
    if (tny==true){        
        $('#trd').datagrid('deleteRow',idx);            
        total = angka(document.getElementById('total').value) - angka(ctot);        
        $('#total').attr('value',number_format(total,2,'.',',')); 
        lnkrg = angka(document.getElementById('nilkont').value) - angka(document.getElementById('total').value) 
        $('#krg').attr('value',number_format(lnkrg,2,'.',','));                              
        kosong2();
    }                     
}
function tambah_detail(){    
    $("#dialog-modal").dialog('open');                    
}
function cetak_bap(){    
    $("#dialog-modal_bap").dialog('open');                    
}


function tutup(){    
    $("#dialog-modal").dialog('close');
    $("#dialog-modal_bap").dialog('close');                      
}

function simpan(){
    var no          = document.getElementById('nomor').value;
    var tgl         = $('#tanggal').datebox('getValue');
    var nilkon      = angka(document.getElementById('nilkont').value);
    var nilapbd     = angka(document.getElementById('nilapbd').value);
    var kdcomp      = $('#compy').combobox('getValue');
    var kdmilik     = $('#milik').combobox('getValue');
    var kdwilayah   =  $('#wilayah').combobox('getValue');
    var kduskpd     = $('#unit').combobox('getValue');
    var jnsdana     = $('#dana').combobox('getValue');
    var tahunang    = $('#tahun').combobox('getValue');
    var buktibyr    = $('#bukti').combobox('getValue');
    var dasaroleh   = $('#dasar').combobox('getValue');
    var nooleh      = document.getElementById('dsno').value;
    var tgloleh     = $('#dstgl').datebox('getValue');
    var tahunoleh   = $('#thn2').combobox('getValue');            
    var tot         = angka(document.getElementById('total').value);   
    var cr_oleh     = $('#perolehan').combobox('getValue');   
    
   
    if (no==''){
        alert('Nomor Dokumen Tidak Boleh Kosong');
        exit();
    } 
    if (tgl==''){
        alert('Tanggal Dokumen Tidak Boleh Kosong');
        exit();
    }
    if (kdcomp==''){
        alert('Kode Perusahaan Tidak Boleh Kosong');
        exit();
    }
    if (kdwilayah==''){
        alert('Kode Wilayah Tidak Boleh Kosong');
        exit();
    }            
    if (kduskpd==''){
        alert('Kode unit Tidak Boleh Kosong');
        exit();
    }       
    
    csql_h = " values('"+no+"','"+kdcomp+"','"+tgl+"','"+kdmilik+"','"+kdwilayah+"','"+kduskpd+"','"+kduskpd+"','"+jnsdana+"','"+buktibyr+"','"+dasaroleh+"','"+nooleh+"','"+tahunang+"','','"+tgloleh+"','"+tahunoleh+"','"+nilkon+"','"+nilapbd+"','user','<?php echo date('y-m-d H:i:s'); ?>','"+tot+"','"+cr_oleh+"')";
 
    $(document).ready(function(){
        $.ajax({
            type: "POST",       
            dataType : 'json',         
            data: ({tabel:'trh_isianbrg',no:no,sql:csql_h}),
            url: '<?php echo base_url(); ?>index.php/transaksi/simpan_isianbrg',
            success:function(data){
                    $.each(data,function(i,n){                                    
                        pesan = n['pesan'];
                        alert(pesan);                              
                    });
              
                   $('#trd').datagrid('selectAll');
                   var rows = $('#trd').datagrid('getSelections');    
                   if (rows!=0){
                       for(var lp=0;lp<rows.length;lp++){    
                            no      =  rows[lp].no_dokumen;  
                            cjns    =  rows[lp].jns;   
                            cnmjns  =  rows[lp].nm_golongan;                                         
                            kdbrg   =  rows[lp].kd_brg;
                            nmbrg   =  rows[lp].nm_brg;
                            sdana   =  rows[lp].s_dana;                         
                            nosp2d  =  rows[lp].no_sp2d;
                            tglsp2d =  rows[lp].tgl_sp2d;
                            nilsp2d =  angka(rows[lp].nilai_sp2d);
                            nilkont =  angka(rows[lp].nilai_kontrak);
                            kdgiat  =  rows[lp].kd_kegiatan;
                            kdrek5  =  rows[lp].kd_rek5;                        
                            jml     =  angka(rows[lp].jumlah);
                            hrg     = angka(rows[lp].harga);
                            cppn    = angka(rows[lp].ppn);
                            tot     = angka(rows[lp].total);
                            ket     = rows[lp].keterangan;
                            invt    = rows[lp].invent;                                                                                       			                                                                                                                                                                               
                            if (lp>0) {
                                csql = csql + ",('"+no+"','"+kdbrg+"','"+nmbrg+"','"+kdrek5+"','"+jml+"','"+hrg+"','"+tot+"','"+nosp2d+"','"+tglsp2d+"','"+nilsp2d+"','"+ket+"','"+invt+"','"+cppn+"','0','"+sdana+"','"+kdgiat+"','"+cjns+"','"+nilkont+"')";
                            } else {
                                csql = " values('"+no+"','"+kdbrg+"','"+nmbrg+"','"+kdrek5+"','"+jml+"','"+hrg+"','"+tot+"','"+nosp2d+"','"+tglsp2d+"','"+nilsp2d+"','"+ket+"','"+invt+"','"+cppn+"','0','"+sdana+"','"+kdgiat+"','"+cjns+"','"+nilkont+"')";                                            
                            }                                                                                          
             			}     
                                                                                               
                    $(document).ready(function(){     
                        $.ajax({
                            type: "POST",   
                            dataType : 'json',                 
                            data: ({tabel:'trd_isianbrg',no:no,sql:csql}),
                            url: '<?php echo base_url(); ?>index.php/transaksi/simpan_isianbrg',
                            success:function(data){                        
                                $.each(data,function(i,n){                                    
                                    pesan = n['pesan'];
                                    alert(pesan);                              
                                });                                          
                            }
                        });
                    });
                   }  
                   //$('#trh').edatagrid('reload');                                                                                                    
            }
        });
   });  
   //$('#trh').edatagrid('reload');                               
}

function segarkan(){
    $('#trh').edatagrid('reload');
}

function tes(){
       $('#trd').datagrid('selectAll');
       var rows = $('#trd').datagrid('getSelections');                       
       for(var lp=0;lp<rows.length;lp++){
        alert(lp);
       }
}

function cetak(){
      
      
      $('#trd').datagrid('selectAll');
      var rows = $('#trd').datagrid('getSelections');    
      var ltotbaris = rows.length;
      lcisi = '&total_baris='+ltotbaris;
      for(var lp=0;lp<rows.length;lp++){ 
         lp1 = lp+1;
         lcnmbar = 'nmbar'+lp1;
         lcisibar = rows[lp].nm_brg;
         lcvol = 'vol'+lp1;
         lcisivol = rows[lp].jumlah;
         lcharga = 'harga'+lp1;
         lcisiharga = rows[lp].harga;
         lctot = 'total'+lp1;
         lcisitot = rows[lp].total;
         
         lcisi = lcisi+'&'+lcnmbar+'='+lcisibar+'&'+lcvol+'='+lcisivol+'&'+lcharga+'='+lcisiharga+'&'+lctot+'='+lcisitot;
      }
     // alert(lcisi);
      
      url = "<?php echo base_url(); ?>index.php/laporan/ctk_bap";
      url1 = "<?php echo base_url(); ?>index.php/laporan/ctk_bap1";
      var lcnmunit = $('#unit').combobox('getValue'); 
      var lcnobap = document.getElementById('no_bap').value;
      var lchari = $('#hari').combobox('getValue'); 
      var lccom = $('#compy').combobox('getValue');
      var ldtglbap = $('#tgl_bap').datebox('getValue'); 
      var ldtgl_cetak = $('#tgl_ctk_bap').datebox('getValue');
      var lckepda = document.getElementById('kepda').value;
      var lcbln = $('#bln_bap').combobox('getValue'); 
      var ldtgl_kep = $('#tgl_kep').datebox('getValue');
      var lcthn = document.getElementById('tahun_bap').value;
      var lcawas1 = $('#pengawas1').combobox('getValue');
      var lcawas2 = $('#pengawas2').combobox('getValue');
      var lcawas3 = $('#pengawas3').combobox('getValue');
      var lcawas4 = $('#pengawas4').combobox('getValue');
      var lcawas5 = $('#pengawas5').combobox('getValue');
      var lcawas6 = $('#pengawas6').combobox('getValue');
      var lcawas7 = $('#pengawas7').combobox('getValue');
      var lcjabat1 = $('#jabat_awas1').combobox('getValue');
      var lcjabat2 = $('#jabat_awas2').combobox('getValue');
      var lcjabat3 = $('#jabat_awas3').combobox('getValue');
      var lcjabat4 = $('#jabat_awas4').combobox('getValue');
      var lcjabat5 = $('#jabat_awas5').combobox('getValue');
      var lcjabat6 = $('#jabat_awas6').combobox('getValue');
      var lcjabat7 = $('#jabat_awas7').combobox('getValue');
      
      var lckontrak = document.getElementById('kontrak_bap').value;
      var ldtgl_kontrak = $('#tgl_kontrak_bap').datebox('getValue');
      var lckegiatan = document.getElementById('kegiatan_bap').value;
      var lckerja = document.getElementById('pekerjaan_bap').value;
      var lclokasi = document.getElementById('lokasi_bap').value;
      var lnnilai_bap = document.getElementById('nilai_bap').value;
      var lcsumberdana = document.getElementById('dana_bap').value;
       
      lc1 = '?no_bap='+lcnobap+'&hari='+lchari+'&tgl_bap='+ldtglbap+'&tgl_cetak='+ldtgl_cetak+'&kepda='+lckepda+'&bln_bap='+lcbln+'&tgl_kep='+ldtgl_kep;
      lc2 = '&tahun_bap='+lcthn+'&pengawas1='+lcawas1+'&pengawas2='+lcawas2+'&pengawas3='+lcawas3+'&pengawas4='+lcawas4+'&pengawas5='+lcawas5+'&pengawas6='+lcawas6+'&pengawas7='+lcawas7;
      lc3 = '&jabat1='+lcjabat1+'&jabat2='+lcjabat2+'&jabat3='+lcjabat3+'&jabat4='+lcjabat4+'&jabat5='+lcjabat5+'&jabat6='+lcjabat6+'&jabat7='+lcjabat7+'&comp='+lccom;
      lc4 = '&kontrak='+lckontrak+'&tgl_kontrak='+ldtgl_kontrak+'&kegiatan='+lckegiatan+'&pekerjaan='+lckerja+'&lokasi='+lclokasi+'&nilai='+lnnilai_bap+'&dana='+lcsumberdana+'&nmunit='+lcnmunit;
      
      lc = lc1+lc2+lc3+lc4;
      //alert(lc);
      
      var pariabel = url1+lc+lcisi;
      alert(pariabel);
      cetak_bap1(pariabel);
      window.open(url+lc,'_blank');
      window.focus();  
      
        
     // window.open(url,'_blank');
      //window.focus();
    } 
    
    function cetak_bap1(pariabel){
        window.open(pariabel,'_blank');
        window.focus();
    }

    function coba(){
        lc = '';
        for(var lp=0;lp<5;lp++){
            lcpar = 'par'+lp
            lcisi = 'isi'+lp
                        
            lc = lc + '&'+lcpar+'='+lcisi
            
        }
        alert(lc)
    }

</script>

<div id="tabs" class="easyui-tabs">
    <ul style="background-color:#2da305;">
        <li><a href="#tabs-1" style="width: 453px;" id="tabs1" onclick="javascript:segarkan()">List View</a></li>
        <li><a href="#tabs-2" style="width: 453px;" id="tabs2">Form Input</a></li>        
    </ul>
    <div id="tabs-1">
        <div>
            <p align="right">
                <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();tab2();">Tambah</a>
                <a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a>                           
                <a class="easyui-linkbutton" iconCls="icon-search" plain="true" >Cari</a>
                <input type="text" value="" id="txtcari"/>
                <input type="hidden" value="" id="txtnodok_h"/>
                <div title="Untuk Edit Data, Klik 2x Di Baris Yang Akan di Edit">              
                <table  id="trh" title="List Dokumen" style="width:940px;height:400px;" >  
                </table>                
                </div>
            </p>
        </div>
    </div>
    <div id="tabs-2">  
        <br /><br />
        <table align="center" border="0">
            <tr>
                <td >No. Dokumen</td>
                <td>:</td>
                <td><input type="text" id="nomor" style="width: 140px;" onclick="javascript:select();"/></td>
                <td width="50px"></td>
                <td >Jenis Dana</td>
                <td>:</td>
                <td><input type="text" id="dana" style="width: 140px;" /></td>                
            </tr>
            <tr>       
                <td>Tanggal Dokumen</td>
                <td>:</td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>
                <td></td>
                <td >Tahun Anggaran</td>
                <td>:</td>
                <td><input type="text" id="tahun" style="width: 140px;" /></td>     
            </tr>
            <tr>
                <td >Nilai Kontrak</td>
                <td>:</td>
                <td><input type="text" id="nilkont" name="nilkont" style="width: 140px;text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))"/></td>
                <td></td>
                <td >Bukti Pembayaran</td>
                <td>:</td>
                <td><input type="text" id="bukti" style="width: 140px;" /></td> 
            </tr>
            <tr>
                <td>Nilai APBD</td> 
                <td>:</td>
                <td><input type="text" id="nilapbd" style="width: 140px;text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))" /></td>
                <td></td>
                <td >Cara Perolehan</td>
                <td>:</td>
                <td><input type="text" id="perolehan" style="width: 140px;" /></td>
                                               
            </tr>       
            <tr>
                <td>Perusahaan/Rekanan</td>
                <td>:</td>
                <td><input id="compy" name="compy" style="width: 140px;" value="" />  </td>
                <td></td>
                <td >Dasar Perolehan</td>
                <td>:</td>
                <td><input type="text" id="dasar" style="width: 140px;" /></td>  
                         
            </tr>                       
            <tr>
                <td colspan="3"><hr /></td>
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;a.Nomor</td>
                <td>:</td>
                <td><input type="text" id="dsno" style="width: 140px;" /></td>    
                
            </tr>
            <tr>
                <td>Kepemilikan</td>
                <td>:</td>
                <td><input id="milik" name="milik" style="width: 140px;" value=""/></td>
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;b.Tanggal</td>
                <td>:</td>
                <td><input type="text" id="dstgl" style="width: 140px;" /></td>
                
            </tr>                
            <tr>
                <td>Wilayah</td>
                <td>:</td>
                <td><input id="wilayah" name="wilayah" style="width: 140px;" value=""/></td>
                <td></td>
                <td >Tahun Perolehan</td>
                <td>:</td>
                <td><input type="text" id="thn2" style="width: 140px;" /></td>
            </tr>
            <tr>
                <td>Unit SKPD</td>
                <td>:</td>
                <td><input id="unit" name="unit" style="width: 140px;" value=""/> <input type="hidden" id="nmunit" name="nmunit" style="width: 140px;" value=""/> </td>
                <td></td>
                <td >Kurang Bayar</td>
                <td>:</td>
                <td><input type="text" id="krg" style="width: 140px;" /></td>
            </tr>
        </table>  
        <br />
        <fieldset>
        <div align="center">
        	<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a>
            <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
            <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak_bap();">cetak</a> 
            <a class="easyui-linkbutton" iconCls="icon-back" plain="true" onclick="javascript:tab1();">Kembali</a>          
        </div>
        </fieldset>
        <br /> 
        <div title="Untuk Edit Data, Klik 2x Di Baris Yang Akan di Edit">
        <table  id="trd" title="Detail Barang" style="width:940px;height:300px;" >  
        </table>
        </div>       
        <div align="right">Total : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
        </table>
        <div id="toolbar" align="center" >
    		<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah_detail();"><b>Tambah Barang</b></a>   		                            		
        </div>
    </div>
</div>


    <div id="dialog-modal" title="Input Barang" >
    <p class="validateTips" >Semua Inputan Harus Di Isi.</p>     
    <fieldset title="Spesifikasi Barang" >    
        <table>
			<tr>
                <td>Golongan Barang</td>
                <td>:</td>
                <td><input type="text" id="cmbjenis" style="width: 140px;" /></td>
            </tr>
			<tr>
                <td>Bidang Barang</td>
                <td>:</td>
                <td><input type="text" id="cmbidang" style="width: 140px;" /></td>
            </tr>
		    <tr>
                <td>Kelompok Barang</td>
                <td>:</td>
                <td><input type="text" id="cmkel" style="width: 140px;" /></td>
            </tr>
			<tr>
                <td>Sub Kelompok Barang</td>
                <td>:</td>
                <td><input type="text" id="cmsubkel" style="width: 140px;" /></td>
            </tr>
            
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><input type="text" id="kdbrg" style="width: 140px;"/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="text" id="nmbrg" style="width: 500px;border: 0;" readonly="true"/></td>
            </tr>            
        </table>
    </fieldset>
    <fieldset title="Bukti / SP2D">
        <table>
            <tr>
                <td>Sumber Dana</td>
                <td>:</td>
                <td><input type="text" id="sbrdana" style="width: 140px;"/></td>
            </tr>
            <tr>
                <td>No. SP2D</td>
                <td>:</td>
                <td><input type="text" id="nosp2d" style="width: 140px;"/></td>
            </tr>
            <tr>
                <td>Tanggal SP2D</td>
                <td>:</td>
                <td><input type="text" id="tglsp2d" style="width: 140px;"/></td>
            </tr>            
            <tr>
                <td>Nilai SP2D</td>
                <td>:</td>
                <td><input type="text" id="nilsp2d" style="width: 140px;text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))" /></td>
                <td>Nilai Kontrak</td>
                <td>:</td>
                <td><input type="text" id="nilkon1" style="width: 140px;text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))" /></td>
            </tr>
            <tr>
                <td>Kegiatan</td>
                <td>:</td>
                <td><input type="text" id="kegiatan" style="width: 140px;"/></td>
            </tr>
            <tr>
                <td>Rekening</td>
                <td>:</td>
                <td><input type="text" id="rekening" style="width: 140px;"/></td>
            </tr>
        </table>
    </fieldset>
    <fieldset title="Keterangan Barang">
        <table>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><input type="text" id="jumlah" style="width: 140px;text-align: right;" onkeyup="hitung();" onkeypress="return(isNumberKey(event));"/></td>
            </tr>
            <tr>
                <td>Harga Satuan</td>
                <td>:</td>
                <td><input type="text" id="harga" style="width: 140px;text-align: right;" onkeyup="hitung();" onkeypress="return(currencyFormat(this,',','.',event))" /></td>
            </tr>
            <tr>
                <td>Total Harga</td>
                <td>:</td>
                <td><input type="text" id="total1" style="width: 140px;text-align: right;"  readonly="true"/></td>
            </tr>
            <tr>
                <td>PPN&nbsp;&nbsp;&nbsp;<input type="checkbox" id="ppn" onclick="hitung();" /></td>
                <td>:</td>
                <td><input type="text" id="nilppn" style="width: 140px;text-align: right;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Total</td>
                <td>:</td>
                <td><input type="text" id="total2" style="width: 140px;text-align: right;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea id="ket" style="width: 140px;"></textarea></td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <div align="center">
        	<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong2();">Tambah</a>
            <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_save();">Simpan</a>               		  
            <a class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:hapus_detail();">Hapus</a>                                 
            <a class="easyui-linkbutton" iconCls="icon-back" plain="true" onclick="javascript:tutup();">Kembali</a>
        </div>
    </fieldset>
    </div>  
        
    <div id="dialog-modal_bap" title="Cetak Berita Acara Penerimaan Barang" >
        <fieldset title="Spesifikasi Barang" >    
            <table border="0" width="100%">
                <tr>
                    <td width="20%">No BAP</td>
                    <td width="1%">:</td>
                    <td width="25%"><input type="text" id="no_bap" style="width: 200px;" /></td>
                    <td width="8%">&nbsp;</td>
                    <td width="20%">Hari</td>
                    <td width="1%">:</td>
                    <td width="25%"><input type="text" id="hari" style="width: 50px;" /></td>
                </tr>          
                <tr>
                    <td>Tgl. BAP</td>
                    <td>:</td>
                    <td><input type="text" id="tgl_bap" style="width: 100px;" /></td>
                    <td></td>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><input type="text" id="tgl_ctk_bap" style="width: 100px;" /></td>
                </tr>
                <tr>
                    <td>Keputusan Bupati</td>
                    <td>:</td>
                    <td><input type="text" id="kepda" style="width: 200px;" /></td>
                    <td></td>
                    <td>Bulan</td>
                    <td>:</td>
                    <td><input type="text" id="bln_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Tgl.Keputusan</td>
                    <td>:</td>
                    <td><input type="text" id="tgl_kep" style="width: 100px;" /></td>
                    <td></td>
                    <td>Tahun</td>
                    <td>:</td>
                    <td><input type="text" id="tahun_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:1.</td>
                    <td colspan="5"><input type="text" id="pengawas1" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas1" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;2.</td>
                    <td colspan="5"><input type="text" id="pengawas2" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas2" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;3.</td>
                    <td colspan="5"><input type="text" id="pengawas3" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas3" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;4.</td>
                    <td colspan="5"><input type="text" id="pengawas4" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas4" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;5.</td>
                    <td colspan="5"><input type="text" id="pengawas5" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas5" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;6.</td>
                    <td colspan="5"><input type="text" id="pengawas6" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas6" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;7.</td>
                    <td colspan="5"><input type="text" id="pengawas7" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas7" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td>No Kontrak</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="kontrak_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Tgl Kontrak</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="tgl_kontrak_bap" style="width: 100px;" /></td>
                </tr>
                <tr>
                    <td>Kegiatan</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="kegiatan_bap" style="width: 580px;" /></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="pekerjaan_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="lokasi_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Nilai Kontrak</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="nilai_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Sumber Dana</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="dana_bap" style="width: 200px;" /></td>
                </tr>
            </table>
        </fieldset>
         <fieldset style="alignment-adjust: ;">
            <div align="center">
                <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();return false">Cetak</a>                               
                <a class="easyui-linkbutton" iconCls="icon-back" plain="true" onclick="javascript:tutup();">Kembali</a>
            </div>
            
        </fieldset>
    
    </div>




        
