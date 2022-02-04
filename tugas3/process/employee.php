<?php

    class Employee{
        protected $host = "localhost";
        protected $username = "root";
        protected $password = "";
        protected $dataBase = "data_employee";
        protected $data = "";
        
        public function __construct(){
            
           $this->konek = mysqli_connect($this->host, $this->username , $this->password ,$this->dataBase);

            
        }
        
        // Fungsi Menampilkan data devisi
        public function tampilDevisi(){
            $divisi = mysqli_query($this->konek,"SELECT * FROM data_divisi ORDER BY id DESC");
            $rows=[];
            while($row = mysqli_fetch_assoc($divisi)){
                $rows[] = $row;
            }
		    return $rows;
        }
        // Fungsi Menampilkan data gaji
        public function tampilGaji(){
            $gaji = mysqli_query($this->konek,"SELECT * FROM data_gaji");
		    return $gaji;
        }
        // Fungsi Menampilkan data
        public function tampilData(){
            $data = mysqli_query($this->konek,"SELECT * FROM data_karyawan ORDER BY id DESC");
		    return $data;
        }
        // Fungsi menambah data
        public function tambahData($data){
            $name = htmlspecialchars($data["name"]);
            $age = htmlspecialchars($data["age"]);
            $division = htmlspecialchars($data["division"]);
            $salary = htmlspecialchars($data["salary"]);
            $gaji = htmlspecialchars($data["gaji"]);

            if($gaji === "Gaji Naik"){
                $salary = $salary * 1.1;
            } else if($gaji === "Gaji Turun"){
                $salary = $salary - ($salary * 0.05);
            } else{
                $salary = $salary;
            }
            
            mysqli_query($this->konek, "INSERT INTO data_karyawan SET  name='$name',age='$age',division='$division',salary='$salary'");
            echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href='../index.php';
            </script>";
        }  
        // Menampilkan data per id
        public function dataId($id){
            $result = mysqli_query($this->konek, "SELECT * FROM data_karyawan WHERE id=$id");
            $rows=[];
            while($row = mysqli_fetch_assoc($result)){
                $rows[] = $row;
            }
            return $rows;
        }
        // fungsi Update data
        public function updateData($data){
            $id = $data["id"];
            $name = htmlspecialchars($data["name"]);
            $age = htmlspecialchars($data["age"]);
            $division = htmlspecialchars($data["division"]);
            $salary = htmlspecialchars($data["salary"]);
            $gaji = htmlspecialchars($data["gaji"]);

            if($gaji === "Gaji Naik"){
                $salary = $salary * 1.1;
            } else if($gaji === "Gaji Turun"){
                $salary = $salary - ($salary * 0.05);
            } else{
                $salary = $salary;
            } 
            $query ="UPDATE data_karyawan SET  name='$name',age='$age',division='$division',salary='$salary' WHERE id=$id";
            if(mysqli_query($this->konek,$query ) ){
                mysqli_affected_rows($this->konek);
                echo "<script>
                alert('Data berhasil di Update!');
                document.location.href='../index.php';
                </script>";
            };
        }

        //fungsi menghapus data
        public function hapusData($id){
           if (mysqli_query($this->konek,"DELETE FROM data_karyawan WHERE id=$id")){
            echo "<script>
            alert('data sudah di hapus');
            document.location.href='../index.php';
            </script>";
        };
        } 
        

        
        
    }


?>