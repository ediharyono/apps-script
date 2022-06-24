public function from_googlesheet()
{
		$curl_handle = curl_init();	
		//$url = "https://script.google.com/macros/s/AKfycbyWSDzUyFa41fu_6QWP7h8ToklwWysGZsuSPaRnu649DmPNYG8/exec";
		
		//https://docs.google.com/spreadsheets/d/1Hw-_bzNE4MDY3LsK4R_XCdG9fL7PFg5o1Ff7GsGGUHg/edit#gid=1179186103
		$url = "https://script.google.com/macros/s/AKfycbwH9hiR6ZdiwoA9GgUyapWtT3JBfbUK7FtGz5EjU2Mh-eBuX_VqIf_pKgQWfgv6y6Mh/exec";
				
		//$url = "https://script.google.com/macros/s/AKfycbyR7Z20pK2joS-QH68rLcJr0CQpIZ0Sx3fL2S6mM-mhsIB2GW4KTHLTfW9Jnlw428B0GA/exec";
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
					'id_pduii_peserta_kelas_kuliah' => $this->uuid->v4(),
					'id_kelas_kuliah'					=> $row["id_kelas_kuliah"], 
					'id_registrasi_mahasiswa'			=> $row["id_registrasi_mahasiswa"], 
					//'id_prodi'			=> $this->session->userdata('id_prodi'), 					
					'nama_kelas_kuliah'			=> $row["nama_kelas_kuliah"], 
					'kode_mata_kuliah'			=> $row["kode_mata_kuliah"], 
					'nama_mata_kuliah'			=> $row["nama_mata_kuliah"], 
					'nim'			=> $row["nim"], 
					'nama_mahasiswa'			=> $row["nama_mahasiswa"], 

			);
          
			$insert = $this->sk->replace($data);
			}
}
/////
