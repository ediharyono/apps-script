public function from_googlesheet()
{
		$curl_handle = curl_init();	
		//https://docs.google.com/spreadsheets/d/1Hw-_bzNE4MDY3LsK4R_XCdG9fL7PFg5o1Ff7GsGGUHg/edit#gid=1179186103
		$url = "https://script.google.com/macros/s/AKfycbzuNjwla-XTibws1KUizlmJPjeDOD_dGDZrJkulwDfiYXgDLODs3EtRxBmCoS9KmXghoA/exec";
								curl_setopt($curl_handle, CURLOPT_URL, $url);
								curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true); 
								curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
								$result_profil = curl_exec($curl_handle);
								$coba = json_decode($result_profil);
								$data_sync = json_encode($coba->data,true);	
						curl_close($curl_handle);
		echo $data_sync;	

		$this->load->library('Uuid');
		$data ='';
		$array = json_decode($data_sync, true); //Convert JSON String into PHP Array
		  
        foreach($array as $row) //Extract the Array Values by using Foreach Loop
          {
			$data = array (
					'id_pduii_aktivitasmahasiswa' => $this->uuid->v4(),
					'id_aktivitas' => '',
					//'id_aktivitas' => $row["id_aktivitas"],
					'jenis_anggota' => $row["jenis_anggota"],
					'nama_jenis_anggota' => $row["nama_jenis_anggota"],
					'id_jenis_aktivitas' => $row["id_jenis_aktivitas"],
					'id_prodi' => $row["id_prodi"],
					'nama_prodi' => $row["nama_prodi"],
					'id_semester' => $row["id_semester"],
					'nama_semester' => $row["semester"],
					'judul' => $row["judul"],
					'keterangan' => $row["keterangan"],
					'lokasi' => $row["lokasi"],
					'sk_tugas' => $row["sk_tugas"],
					'tanggal_sk_tugas' => $row["tanggal_sk_tugas"],
					'nim'          =>$row["nim"], 		
					'jenis_aktivitas' => $row["jenis_aktivitas"],

						'nidn_dosen_pembimbing'          =>$row["nidn_dosen_pembimbing"], 
						'id_sub_aktivitas'          =>$row["id_sub_aktivitas"], 
						'nidn_dosen_penguji'          =>$row["nidn_dosen_penguji"], 						
						'id_sub_aktivitas'          =>$row["id_sub_aktivitas"],  
						'id_sub_aktivitas_penguji_1'          =>$row["id_sub_aktivitas_penguji_1"],  

						'id_aktivitas_dummy'          =>$row["id_aktivitas"],

						'nidn_dosen_pembimbing_2'          =>$row["nidn_dosen_pembimbing_2"], 
						'id_sub_aktivitas_bimbing_2'          =>$row["id_sub_aktivitas_bimbing_2"],  						
						'nidn_dosen_pembimbing_3'          =>$row["nidn_dosen_pembimbing_3"], 						
						'id_sub_aktivitas_bimbing_3'          =>$row["id_sub_aktivitas_bimbing_3"],  												
						'nidn_dosen_pembimbing_4'          =>$row["nidn_dosen_pembimbing_4"], 										
						'id_sub_aktivitas_bimbing_4'          =>$row["id_sub_aktivitas_bimbing_4"],  												
						'nidn_dosen_penguji_2'          =>$row["nidn_dosen_penguji_2"], 
						'id_sub_aktivitas_penguji_2'          =>$row["id_sub_aktivitas_penguji_2"],  							
						'nidn_dosen_penguji_3'          =>$row["nidn_dosen_penguji_3"],
						'id_sub_aktivitas_penguji_3'          =>$row["id_sub_aktivitas_penguji_3"],  						 
						'nidn_dosen_penguji_4'          =>$row["nidn_dosen_penguji_4"], 
						'id_sub_aktivitas_penguji_4'          =>$row["id_sub_aktivitas_penguji_4"],  
			);
          
			$insert = $this->sk->replace($data);
			}
}
