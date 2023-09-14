DOCUMENT API

GET: {nama_domain}/api/documents => Untuk mengakses semua data dokumen yang tersimpan dalam basis data
POST: {nama_domain}/api/documents => Untuk menambahkan data baru dalam dokumen dengan input email_reciever, title, content, signing (berupa gambar berekstensi .png)
PUT/PATCH: {nama_domain}/api/documents/{id} => Untuk mengubah data yang tersimpan dengan id tertentu.
DELETE: {nama_domain}/api/documents/{id} => Untuk menghapus data yang tersimpan sesuai dengan id yang dikirimkan
GET: {nama_domain}/api/documents/{id} => Untuk menampilkan detail data dengan id tertentu