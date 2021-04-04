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

##### <h1 KETERANGAN LEBIH LANJUT UNTUK KATA BERCETAK BIRU


#### <a name="externalDocumentationObject"></a>External Documentation Object

Allows referencing an external resource for extended documentation.

##### Fixed Fields

Field Name | Type | Description
---|:---:|---
<a name="externalDocDescription"></a>description | `string` | A description of the target documentation. [CommonMark syntax](https://spec.commonmark.org/) MAY be used for rich text representation.
<a name="externalDocUrl"></a>url | `string` | **REQUIRED**. The URL for the target documentation. This MUST be in the form of a URL.

This object MAY be extended with [Specification Extensions](#specificationExtensions).

##### External Documentation Object Example

```json
{
  "description": "Find more info here",
  "url": "https://example.com"
}
```

```yaml
description: Find more info here
url: https://example.com
```

#### <a name="parameterObject"></a>Parameter Object

Describes a single operation parameter.

A unique parameter is defined by a combination of a [name](#parameterName) and [location](#parameterIn).

##### Parameter Locations
There are four possible parameter locations specified by the `in` field:
* path - Used together with [Path Templating](#pathTemplating), where the parameter value is actually part of the operation's URL. This does not include the host or base path of the API. For example, in `/items/{itemId}`, the path parameter is `itemId`.
* query - Parameters that are appended to the URL. For example, in `/items?id=###`, the query parameter is `id`.
* header - Custom headers that are expected as part of the request. Note that [RFC7230](https://tools.ietf.org/html/rfc7230#page-22) states header names are case insensitive.
* cookie - Used to pass a specific cookie value to the API.


#### <a name="referenceObject"></a>Reference Object

A simple object to allow referencing other components in the OpenAPI document, internally and externally.

The `$ref` string value contains a URI [RFC3986](https://tools.ietf.org/html/rfc3986), which identifies the location of the value being referenced.


#### <a name="pathItemParameters"></a>Path Item Parameter
<a name="pathItemParameters"></a>parameters | [[Parameter Object](#parameterObject) \| [Reference Object](#referenceObject)] | A list of parameters that are applicable for all the operations described under this path. These parameters can be overridden at the operation level, but cannot be removed there. The list MUST NOT include duplicated parameters. A unique parameter is defined by a combination of a [name](#parameterName) and [location](#parameterIn). The list can use the [Reference Object](#referenceObject) to link to parameters that are defined at the [OpenAPI Object's components/parameters](#componentsParameters). 

#### <a name="parameterName"></a>Parameter Name
<a name="parameterName"></a>name | `string` | **REQUIRED**. The name of the parameter. Parameter names are *case sensitive*. <ul><li>If [`in`](#parameterIn) is `"path"`, the `name` field MUST correspond to a template expression occurring within the [path](#pathsPath) field in the [Paths Object](#pathsObject). See [Path Templating](#pathTemplating) for further information.<li>If [`in`](#parameterIn) is `"header"` and the `name` field is `"Accept"`, `"Content-Type"` or `"Authorization"`, the parameter definition SHALL be ignored.<li>For all other cases, the `name` corresponds to the parameter name used by the [`in`](#parameterIn) property.</ul>

#### <a name="parameterIn"></a>Parameter In
<a name="parameterIn"></a>in | `string` | **REQUIRED**. The location of the parameter. Possible values are `"query"`, `"header"`, `"path"` or `"cookie"`.

#### <a name="referenceObject"></a>Reference Object

A simple object to allow referencing other components in the OpenAPI document, internally and externally.

The `$ref` string value contains a URI [RFC3986](https://tools.ietf.org/html/rfc3986), which identifies the location of the value being referenced.

#### <a name="responsesObject"></a>Responses Object

A container for the expected responses of an operation.
The container maps a HTTP response code to the expected response.

The documentation is not necessarily expected to cover all possible HTTP response codes because they may not be known in advance.
However, documentation is expected to cover a successful operation response and any known errors.

The `default` MAY be used as a default response object for all HTTP codes 
that are not covered individually by the `Responses Object`.

The `Responses Object` MUST contain at least one response code, and if only one
response code is provided it SHOULD be the response for a successful operation
call.

#### <a name="callbackObject"></a>Callback Object

A map of possible out-of band callbacks related to the parent operation.
Each value in the map is a [Path Item Object](#pathItemObject) that describes a set of requests that may be initiated by the API provider and the expected responses.
The key value used to identify the path item object is an expression, evaluated at runtime, that identifies a URL to use for the callback operation.

To describe incoming requests from the API provider independent from another API call, use the [`webhooks`](#oasWebhooks) field.


#### <a name="securityRequirementObject"></a>Security Requirement Object

Lists the required security schemes to execute this operation.
The name used for each property MUST correspond to a security scheme declared in the [Security Schemes](#componentsSecuritySchemes) under the [Components Object](#componentsObject).

Security Requirement Objects that contain multiple schemes require that all schemes MUST be satisfied for a request to be authorized.
This enables support for scenarios where multiple query parameters or HTTP headers are required to convey security information.

When a list of Security Requirement Objects is defined on the [OpenAPI Object](#oasObject) or [Operation Object](#operationObject), only one of the Security Requirement Objects in the list needs to be satisfied to authorize the request.

#### <a name="serverObject"></a>Server Object

An object representing a Server.


### <a name="specificationExtensions"></a>Specification Extensions

While the OpenAPI Specification tries to accommodate most use cases, additional data can be added to extend the specification at certain points.

The extensions properties are implemented as patterned fields that are always prefixed by `"x-"`.

Field Pattern | Type | Description
---|:---:|---
<a name="infoExtensions"></a>^x- | Any | Allows extensions to the OpenAPI Schema. The field name MUST begin with `x-`, for example, `x-internal-id`. Field names beginning `x-oai-` and `x-oas-` are reserved for uses defined by the [OpenAPI Initiative](https://www.openapis.org/). The value can be `null`, a primitive, an array or an object.

The extensions may or may not be supported by the available tooling, but those may be extended as well to add requested support (if tools are internal or open-sourced).