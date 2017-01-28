<div class='container'>
	<div class='innerContainer'>
		<div class='size400px'>
			<div class='sectionTitle'>
				<h2>Pilih Kategori</h2>
				<span><?php echo $nama_produk ;echo($nama_jenis!=""?">>".$nama_jenis:"");?></span>
			</div>
			<?php
				foreach($fetch->result() as $produk){
					$nama = urlType($produk->nama);
					echo "<a href='".base_url()."admin/edit/$nama' class='card'>$produk->nama</a>";
				}
			?>
		</div>
		
	</div>
</div>