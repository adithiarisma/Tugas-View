# OpenAPI Specification

## Apa itu OpenAPI Specification ?

Spesifikasi OpenAPI (OAS) mendefinisikan standar, antarmuka bahasa-agnostik ke HTTP API yang memungkinkan manusia dan komputer untuk menemukan dan memahami kapabilitas layanan tanpa akses ke kode sumber, dokumentasi, atau melalui inspeksi lalu lintas jaringan. Jika ditentukan dengan benar, konsumen dapat memahami dan berinteraksi dengan layanan jarak jauh dengan jumlah logika implementasi yang minimal.

Definisi OpenAPI kemudian dapat digunakan oleh alat pembuatan dokumentasi untuk menampilkan API, alat pembuat kode untuk menghasilkan server dan klien dalam berbagai bahasa pemrograman, alat pengujian, dan banyak kasus penggunaan lainnya.


#### <a name="operationObject"></a>Operation Object


##### Definisi
Operasi yang digunakan untuk menjelaskan operasi API tunggal di sebuah jalur.

##### Fixed Fields

Field Name | Type | Description
---|:---:|---
<a name="operationTags"></a>tags | [`string`] | Daftar tag untuk kontrol dokumentasi API. Tag dapat digunakan untuk pengelompokan logis operasi berdasarkan sumber daya atau kualifikasi lainnya.
<a name="operationSummary"></a>summary | `string` | Ringkasan singkat tentang apa yang dilakukan operasi tersebut.
<a name="operationDescription"></a>description | `string` | Penjelasan panjang lebar tentang perilaku operasi. [CommonMark syntax](https://spec.commonmark.org/) DAPAT digunakan untuk representasi teks kaya.
<a name="operationExternalDocs"></a>externalDocs | [External Documentation Object](#externalDocumentationObject) | Dokumentasi eksternal tambahan untuk operasi ini.
<a name="operationId"></a>operationId | `string` | String unik yang digunakan untuk mengidentifikasi operasi. Id HARUS unik di antara semua operasi yang dijelaskan dalam API. Nilai operationId adalah ** case-sensitive **. Alat dan library MUNGKIN menggunakan operationId untuk mengidentifikasi operasi secara unik, oleh karena itu, DIANJURKAN untuk mengikuti konvensi penamaan pemrograman umum.
<a name="operationParameters"></a>parameters | [[Parameter Object](#parameterObject) \| [Reference Object](#referenceObject)] | Daftar parameter yang dapat diterapkan untuk operasi ini. Jika parameter sudah ditentukan di [Path Item](#pathItemParameters), definisi baru akan menimpanya tetapi tidak pernah bisa menghapusnya. Daftar TIDAK HARUS menyertakan parameter duplikat. Parameter unik ditentukan oleh kombinasi dari [name](#parameterName) dan [location](#parameterIn). Daftar tersebut dapat menggunakan [Reference Object](#referenceObject)  untuk menautkan ke parameter yang ditentukan di [OpenAPI Object's components/parameters](#componentsParameters)
<a name="operationRequestBody"></a>requestBody | [Request Body Object](#requestBodyObject) \| [Reference Object](#referenceObject) | Request Body yang berlaku untuk operasi ini. `RequestBody` didukung sepenuhnya dalam metode HTTP dengan spesifikasi HTTP 1.1 [RFC7231](https://tools.ietf.org/html/rfc7231#section-4.3.1) telah secara eksplisit menentukan semantik untuk badan permintaan. Dalam kasus lain ketika spesifikasi HTTP tidak jelas (such as [GET](https://tools.ietf.org/html/rfc7231#section-4.3.1), [HEAD](https://tools.ietf.org/html/rfc7231#section-4.3.2) and [DELETE](https://tools.ietf.org/html/rfc7231#section-4.3.5)), `requestBody` diizinkan tetapi tidak didefinisikan dengan baik semantik dan HARUS dihindari jika memungkinkan.
<a name="operationResponses"></a>responses | [Responses Object](#responsesObject) | Daftar respons yang mungkin saat dikembalikan dari pelaksanaan operasi ini.
<a name="operationCallbacks"></a>callbacks | Map[`string`, [Callback Object](#callbackObject) \| [Reference Object](#referenceObject)] | Peta kemungkinan callback out-of-band yang terkait dengan operasi induk. Kuncinya adalah pengenal unik untuk Objek Callback. Setiap nilai dalam peta adalah[Callback Object](#callbackObject)  yang menjelaskan permintaan yang dapat dimulai oleh penyedia API dan respons yang diharapkan.
<a name="operationDeprecated"></a>deprecated | `boolean` | Menyatakan operasi ini tidak digunakan lagi. Konsumen HARUS menahan diri dari penggunaan operasi yang dideklarasikan. Nilai defaultnya adalah `false`.
<a name="operationSecurity"></a>security | [[Security Requirement Object](#securityRequirementObject)] | Deklarasi mekanisme keamanan mana yang dapat digunakan untuk operasi ini. Daftar nilai mencakup objek persyaratan keamanan alternatif yang dapat digunakan. Hanya satu dari objek persyaratan keamanan yang harus dipenuhi untuk mengotorisasi permintaan. Untuk membuat keamanan opsional, persyaratan keamanan kosong (`{}`) bisa disertakan dalam larik. Definisi ini menimpa tingkat atas yang dideklarasikan [`security`](#oasSecurity). Untuk menghapus deklarasi keamanan level atas, array kosong dapat digunakan.
<a name="operationServers"></a>servers | [[Server Object](#serverObject)] | Larik `server` alternatif untuk melayani operasi ini. Jika objek `server` alternatif ditentukan di Objek Jalur Objek atau tingkat Root, itu akan diganti dengan nilai ini.

Objek ini DAPAT diperpanjang dengan [Specification Extensions](#specificationExtensions).

##### Operation Object Example

```json
{
  "tags": [
    "pet"
  ],
  "summary": "Updates a pet in the store with form data",
  "operationId": "updatePetWithForm",
  "parameters": [
    {
      "name": "petId",
      "in": "path",
      "description": "ID of pet that needs to be updated",
      "required": true,
      "schema": {
        "type": "string"
      }
    }
  ],
  "requestBody": {
    "content": {
      "application/x-www-form-urlencoded": {
        "schema": {
          "type": "object",
          "properties": {
            "name": { 
              "description": "Updated name of the pet",
              "type": "string"
            },
            "status": {
              "description": "Updated status of the pet",
              "type": "string"
            }
          },
          "required": ["status"] 
        }
      }
    }
  },
  "responses": {
    "200": {
      "description": "Pet updated.",
      "content": {
        "application/json": {},
        "application/xml": {}
      }
    },
    "405": {
      "description": "Method Not Allowed",
      "content": {
        "application/json": {},
        "application/xml": {}
      }
    }
  },
  "security": [
    {
      "petstore_auth": [
        "write:pets",
        "read:pets"
      ]
    }
  ]
}
```

```yaml
tags:
- pet
summary: Updates a pet in the store with form data
operationId: updatePetWithForm
parameters:
- name: petId
  in: path
  description: ID of pet that needs to be updated
  required: true
  schema:
    type: string
requestBody:
  content:
    'application/x-www-form-urlencoded':
      schema:
       type: object
       properties:
          name: 
            description: Updated name of the pet
            type: string
          status:
            description: Updated status of the pet
            type: string
       required:
         - status
responses:
  '200':
    description: Pet updated.
    content: 
      'application/json': {}
      'application/xml': {}
  '405':
    description: Method Not Allowed
    content: 
      'application/json': {}
      'application/xml': {}
security:
- petstore_auth:
  - write:pets
  - read:pets
```

##### <a name="externalDocumentationObject"></a>KETERANGAN LEBIH LANJUT UNTUK KATA BERCETAK BIRU


#### <a name="externalDocumentationObject"></a>External Documentation Object

Memungkinkan referensi sumber daya eksternal untuk dokumentasi tambahan.


#### <a name="parameterObject"></a>Parameter Object

Menjelaskan parameter operasi tunggal.

Parameter unik ditentukan dengan kombinasi [name](#parameterName) dan [location](#parameterIn).

##### Parameter Locations

Ada empat kemungkinan lokasi parameter yang ditentukan oleh kolom `in`:
* path - Digunakan bersama dengan [Path Templating](#pathTemplating), di mana nilai parameter sebenarnya adalah bagian dari URL operasi. Ini tidak termasuk host atau jalur dasar API. Misalnya, dalam `/ items / {itemId}`, parameter jalurnya adalah `itemId`.
* query - Parameter yang ditambahkan ke URL. Misalnya, dalam `/ items? Id = ###`, parameter kuerinya adalah `id`.
* header - Header kustom yang diharapkan sebagai bagian dari permintaan. Perhatikan bahwa [RFC7230] (https://tools.ietf.org/html/rfc7230#page-22) menyatakan nama header tidak membedakan huruf besar / kecil.
* cookie - Digunakan untuk mengirimkan nilai cookie tertentu ke API.


#### <a name="referenceObject"></a>Reference Object

Objek sederhana untuk memungkinkan referensi komponen lain dalam dokumen OpenAPI, secara internal dan eksternal.

Nilai string `$ ref` berisi URI [RFC3986] (https://tools.ietf.org/html/rfc3986), yang mengidentifikasi lokasi nilai yang direferensikan.

#### <a name="pathItemParameters"></a>Path Item Parameter
<a name="pathItemParameters"></a>parameters | [[Parameter Object](#parameterObject) \| [Reference Object](#referenceObject)] | Daftar parameter yang dapat diterapkan untuk semua operasi yang dijelaskan pada jalur ini. Parameter ini dapat diganti di tingkat operasi, tetapi tidak dapat dihapus di sana. Daftar TIDAK HARUS menyertakan parameter duplikat. Parameter unik ditentukan oleh kombinasi dari [name](#parameterName) dan [location](#parameterIn). Daftar tersebut dapat menggunakan [Reference Object](#referenceObject) untuk menautkan ke parameter yang ditentukan di [OpenAPI Object's components/parameters](#componentsParameters). 

#### <a name="parameterName"></a>Parameter Name
<a name="parameterName"></a>name | `string` | **REQUIRED**.  Nama parameter. Nama parameter * case sensitive *. 


#### <a name="parameterIn"></a>Parameter In
<a name="parameterIn"></a>in | `string` | **REQUIRED**. Lokasi parameter. Nilai yang memungkinkan adalah `" query "`, `" header "`, `" path "` atau `" cookie "`.

#### <a name="referenceObject"></a>Reference Object

Objek sederhana untuk memungkinkan referensi komponen lain dalam dokumen OpenAPI, secara internal dan eksternal.

Nilai string `$ ref` berisi URI [RFC3986] (https://tools.ietf.org/html/rfc3986), yang mengidentifikasi lokasi nilai yang direferensikan.

#### <a name="responsesObject"></a>Responses Object
Sebuah wadah untuk respons yang diharapkan dari suatu operasi.
Penampung memetakan kode respons HTTP ke respons yang diharapkan.

Dokumentasi tidak selalu diharapkan mencakup semua kemungkinan kode respons HTTP karena mungkin tidak diketahui sebelumnya.
Namun, dokumentasi diharapkan mencakup respons operasi yang berhasil dan kesalahan yang diketahui.

`Default` MUNGKIN digunakan sebagai objek respons default untuk semua kode HTTP
yang tidak tercakup satu per satu oleh `Responses Object`.

`Responses Object` HARUS berisi setidaknya satu kode respons, dan jika hanya satu
kode respons yang disediakan SEHARUSNYA merupakan respons untuk operasi yang berhasil
panggilan.

#### <a name="callbackObject"></a>Callback Object

Peta kemungkinan callback out-of-band yang terkait dengan operasi induk.

#### <a name="securityRequirementObject"></a>Security Requirement Object

Mencantumkan skema keamanan yang diperlukan untuk menjalankan operasi ini.

#### <a name="serverObject"></a>Server Object

Objek yang mewakili Server.

### <a name="specificationExtensions"></a>Specification Extensions

Sementara Spesifikasi OpenAPI mencoba mengakomodasi sebagian besar kasus penggunaan, data tambahan dapat ditambahkan untuk memperluas spesifikasi pada titik-titik tertentu.

Properti ekstensi diimplementasikan sebagai bidang berpola yang selalu diawali dengan `" x- "`.

Field Pattern | Type | Description
---|:---:|---
<a name="infoExtensions"></a>^x- | Any | Mengizinkan ekstensi ke Skema OpenAPI. Nama kolom HARUS dimulai dengan `x-`, misalnya, `x-internal-id`. Nama kolom yang diawali dengan `x-oai-` dan `x-oas-` dicadangkan untuk penggunaan yang ditentukan oleh [OpenAPI Initiative] (https://www.openapis.org/). Nilainya bisa berupa `null`, primitif, array atau objek.

Ekstensi mungkin atau mungkin tidak didukung oleh perkakas yang tersedia, tetapi itu dapat diperpanjang juga untuk menambahkan dukungan yang diminta (jika alat bersifat internal atau bersumber terbuka).