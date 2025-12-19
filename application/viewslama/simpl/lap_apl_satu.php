 <script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
   
	<script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk = '';
                    
    
    function kosong(){
        $("#kdmilik").attr("value",'');
        $("#nmmilik").attr("value",''); 
    }
    
    function opt(val){  
        ctk = val;
        if (ctk=='1'){
            $("#div_skpd").show();
            $("#div_kop").hide();
        } 
		else if (ctk=='2'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='3'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='4'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='5'){
            $("#div_skpd").show();
            $("#div_kop").show();
            } 
		else if (ctk=='6'){ 
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='7'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='8'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='9'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='10'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='11'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='12'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='13'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='14'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='15'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='16'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='17'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='18'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='19'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
		else if (ctk=='20'){
            $("#div_skpd").show();
            $("#div_kop").hide();
            } 
			else {
            exit();
        }                 
    }     
	
	function kop(val){
	ats=val;
	}
    function openWindow( url ){
   
        switch(ctk)
            {
			
            case '1':
                var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+''; 
				window.open(url+lc,'_blank');
                window.focus();
                break;
            case '2':
			 var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '3':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '4':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '5': 
				var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'&kop='+ats+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '6':
				var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '7':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '8':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '9':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '10':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '11':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '12':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '13':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '14':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '15':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '16':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '17':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '18':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '19':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            case '20':
			var kode = $('#plh_simpl').combogrid('getValue');
				lc ='?kode='+kode+'&ctk='+ctk+'';
				window.open(url+lc,'_blank');
                window.focus();
				break;
            default:
                var cskpd 	= '';
                var cnmskpd = '';
                var cbidang = '';
                var cnmbid 	= '';
                var ctahu 	= document.getElementById('nip_tahu').value;
                var cbend 	= document.getElementById('nip_bend').value;
                var ctgl 	= $('#tgl_cetak').datebox('getValue');
                lc = '?kd_skpd='+cskpd+'&kd_bid='+cbidang+'&nm_skpd='+cnmskpd+'&nm_bid='+cnmbid+'&tahu='+ctahu+'&bend='+cbend+'&tgl='+ctgl+'&cpilih=3';
                window.open(url+lc,'_blank');
                window.focus();
            }
    } 
    
    $(function(){
        $("#div_skpd").hide();
        $("#div_kop").hide();
        $("#div_bidang").hide();
   	});  
    
    $(function(){
         $('#plh_simpl').combogrid({  
           panelWidth:500,  
           idField:'no_transaksi',  
           textField:'no_transaksi',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/simpl/ambil_plh_form_isian',  
           columns:[[  
               {field:'no_transaksi',title:'No Transaksi',width:100},  
               {field:'nm_kegiatan',title:'Nama Kegiatan',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
		   //$("#nama").attr("value",rowData.nama.toUpperCase());
						$("#kd_uskpd").attr("value",rowData.kd_skpd.toUpperCase());
                        $("#kegiatan").attr("value",rowData.kegiatan.toUpperCase());
						$("#nm_kegiatan").attr("value",rowData.nm_kegiatan.toUpperCase());
                        $("#keterangan").attr("value",rowData.keterangan.toUpperCase());
                        $("#pptk").attr("value",rowData.pptk.toUpperCase());
                        $("#rekanan").attr("value",rowData.rekanan.toUpperCase());	
						$("#staf_penerima").attr("value",rowData.staf_penerima.toUpperCase());
                        $("#ketua").attr("value",rowData.ketua.toUpperCase());
						$("#anggota_satu").attr("value",rowData.anggota_satu.toUpperCase());
                        $("#anggota_dua").attr("value",rowData.anggota_dua.toUpperCase());
						$("#total").attr("value",rowData.total.toUpperCase());
           }  
         });
		 
         $('#tgl_cetak').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
        
    }); 
  
   </script>

<div id="content1"> 
    <h3 align="center"><b>CETAK LAPORAN ADMINISTRASI PENUNJUKAN LANGSUNG</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            
            <tr>
                <td colspan="3">
                <div id="div_skpd">
                        <table style="width:100%;" border="0">
						<tr >
                            <td width="20%"><b>No. Transaksi</b></td>
							<td width="1%">:</td>
                            <td width="100%"><input id="plh_simpl" name="plh_simpl" style="width: 100px;" />
                            <input type="text" id="nm_kegiatan" readonly="true" style="width: 300px;border:0" />
                            </td>
						</tr>
                        </table>
                </div>
                </td>
            </tr>
			<tr>
				<td colspan="3">
                <div id="div_kop">
                        <table style="width:100%;" border="0">
						<tr>
							<td width="10%"><b>Pakai KOP</b></td>
							<td width="1%">:</td>
							<td width="5%"><input type="radio" id="status1" name="kop" value="1" onclick="kop(this.value)"/></td>
							<td width="15%"><b>Tdk Pakai KOP</b></td>
							<td width="1%">:</td>
							<td><input type="radio" id="status1" name="kop" value="2" onclick="kop(this.value)"/></td>
						</tr>
                        </table>
                </div>
                </td>
			</tr>  
			<tr bgcolor="#fcbe02">
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />Rencana Anggaran Biaya &ensp;</td>
                <td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />Harga Perkiraan Sendiri &ensp;</td>
                <td><input type="radio" name="cetak" value="3" id="status1" onclick="opt(this.value)" checked="true" />Undangan Permintaan Penawaran</td>
				<td><input type="radio" name="cetak" value="4" id="status1" onclick="opt(this.value)" checked="true" />Lampiran Undangan Penawaran</td>
            </tr>	
			<tr bgcolor="#fcbe02" hidden="true">
                <td bgcolor="#e5e1e1"><input type="radio" name="cetak" value="5" onclick="opt(this.value)" />Surat Rekanan &ensp;</td>
                <td bgcolor="#e5e1e1"><input type="radio" name="cetak" value="6" id="status" onclick="opt(this.value)" />Pakta Integritas &ensp;</td>
                <td bgcolor="#e5e1e1"><input type="radio" name="cetak" value="15" id="status1" onclick="opt(this.value)" checked="true" />B.A Pemeriksaan Barang/Jasa</td>
                <td bgcolor="#e5e1e1"><input type="radio" name="cetak" value="14" id="status" onclick="opt(this.value)" />B.A Penerimaan Barang/Jasa &ensp;</td>
            </tr>
			<tr bgcolor="#fcbe02">
                <td><input type="radio" name="cetak" value="7" id="status1" onclick="opt(this.value)" checked="true" />Berita Acara Dokumentasi</td>
				<td><input type="radio" name="cetak" value="8" id="status1" onclick="opt(this.value)" checked="true" />Berita Acara Klarifikasi</td>
                <td><input type="radio" name="cetak" value="9" onclick="opt(this.value)" />Lamp. B.A Klarifikasi &ensp;</td>
                <td><input type="radio" name="cetak" value="10" id="status" onclick="opt(this.value)" />Hasil Pengadaan Langsung &ensp;</td>
            </tr>
			<tr bgcolor="#fcbe02">
                <td><input type="radio" name="cetak" value="11" id="status1" onclick="opt(this.value)" checked="true" />SPPBJ</td>
				<td><input type="radio" name="cetak" value="12" id="status1" onclick="opt(this.value)" checked="true" />Surat Perintah Kerja</td>
                <td><input type="radio" name="cetak" value="13" onclick="opt(this.value)" />Surat Pesanan &ensp;</td>
				<td><input type="radio" name="cetak" value="16" id="status1" onclick="opt(this.value)" checked="true" />B.A Serah Terima Hasil Pekerjaan</td>
            </tr>
			<tr bgcolor="#fcbe02">
                <td><input type="radio" name="cetak" value="17" onclick="opt(this.value)" />B.A Pembayaran Pekerjaan &ensp;</td>
                <td><input type="radio" name="cetak" value="18" id="status" onclick="opt(this.value)" />Surat Kuasa &ensp;</td>
				<td><input type="radio" name="cetak" value="19" onclick="opt(this.value)" />Kwitansi &ensp;</td>
                <td><input type="radio" name="cetak" value="20" id="status" onclick="opt(this.value)" />Ringkasan Kontrak &ensp;</td>
            </tr>			
            <tr>
                <td colspan="4" align="center">
                <a  href="<?php echo base_url(); ?>index.php/lap_simpl/lap_rencana_anggaran" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:openWindow(this.href);return false">Cetak</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>



