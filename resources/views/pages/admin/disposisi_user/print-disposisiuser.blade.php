<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Disposisi Surat Masuk</title>
  </head>
  <body>
    
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="text-center">Disposisi Surat Masuk</h4>
                    <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>No Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->letter_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pengirim Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->sender }}</td>
                                        </tr>
                                         <tr>
                                            <th>Subject Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->letter_subject }}</td>
                                        </tr>
                                        <tr>
                                            <th>Isi Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->letter_content }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tgl Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->letter_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tgl Diterima</th>
                                            <td>{{ $item->disposisi->incoming_letters->date_received }}</td>
                                        </tr>
                                        <tr>
                                            <th>Perihal</th>
                                            <td>{{ $item->disposisi->incoming_letters->regarding }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $item->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sifat</th>
                                            <td>{{ $item->disposisi->sifat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Perintah</th>
                                            <td>{{ $item->disposisi->perintah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $item->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jabatan</th>
                                            <td>{{ $item->user->position->position }}</td>
                                        </tr>
                                         <tr>
                                            <th>Email</th>
                                            <td>{{ $item->user->email }}</td>
                                        </tr>
                                    </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        window.print();
        window.onafterprint = window.close;
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>