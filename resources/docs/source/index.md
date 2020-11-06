---
title: API Reference

language_tabs:
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.

<!-- END_INFO -->

#Admin


APIs for managing users
<!-- START_569bccc8050b19fc625e9810812a1d64 -->
## Nuevo usuario (public)

Registra un usuario de tipo admin.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "nombre_completo": "waldo",
    "email": "waldo@waldo.com",
    "password": "waldo123123",
    "password_confirmation": "waldo123123",
    "foto": "null"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "email": "waldo@waldo.com",
    "foto": null,
    "id": 18,
    "nombre_completo": "waldo"
}
```

### HTTP Request
`POST api/admin/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nombre_completo` | string |  required  | para el admin.
        `email` | email |  required  | para el user.
        `password` | string |  required  | para el password minimo 8 caracteres.
        `password_confirmation` | string |  required  | para el password minimo 8 caracteres.
        `foto` | string |  optional  | string base 64
    
<!-- END_569bccc8050b19fc625e9810812a1d64 -->

#Cita


Una cita puede ser creada solo por un medico, puede 
ser vista por un paciente y el medico mismo, tambien 
puede ser registada por el paciente con espera a que la misma
sea aprovada por el medico
<!-- START_a57dcd3900b9176e844e02f94df514bb -->
## create

Registra una nueva cita este, registro es echo por un usuario de tipo medico

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/cita/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "paciente_id": 2,
    "fecha": "\"2020-05-23\"",
    "hora": "\"12:00\"",
    "respuesta": "null"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 12,
    "medico_id": 1,
    "medico": {
        "id": 1,
        "nombre_completo": "katara caballero otsank",
        "direccion": "avensaida los angeles de charly",
        "ciudad": "parags222asuay",
        "celular": "4344436",
        "src_foto": "medico_1200610162742.jpg",
        "src_matricula": "medico_matricula_1200607141802.jpg",
        "player_id": "123123123",
        "user_id": 1,
        "created_at": "2020-06-04T21:21:16.000000Z",
        "updated_at": "2020-06-10T16:27:43.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
        "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
    },
    "paciente_id": 1,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "fecha": "2020-06-05",
    "hora": "06:00",
    "aprovada": true,
    "pendiente": true,
    "mensaje": null
}
```

### HTTP Request
`POST api/cita/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `paciente_id` | integer |  required  | 
        `fecha` | date |  required  | 
        `hora` | time |  required  | 
        `respuesta` | string |  optional  | 
    
<!-- END_a57dcd3900b9176e844e02f94df514bb -->

<!-- START_889879f674e60490e8688801d1b793d8 -->
## show

Muestra los datos de una cita

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/cita/show/quo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 12,
    "medico_id": 1,
    "medico": {
        "id": 1,
        "nombre_completo": "katara caballero otsank",
        "direccion": "avensaida los angeles de charly",
        "ciudad": "parags222asuay",
        "celular": "4344436",
        "src_foto": "medico_1200610162742.jpg",
        "src_matricula": "medico_matricula_1200607141802.jpg",
        "player_id": "123123123",
        "user_id": 1,
        "created_at": "2020-06-04T21:21:16.000000Z",
        "updated_at": "2020-06-10T16:27:43.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
        "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
    },
    "paciente_id": 1,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "fecha": "2020-06-05",
    "hora": "06:00",
    "aprovada": false,
    "mensaje": "in need a consult"
}
```

### HTTP Request
`GET api/cita/show/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de la cita

<!-- END_889879f674e60490e8688801d1b793d8 -->

<!-- START_ed7d6157d1b4d8473953c4a520853417 -->
## update

Modifica los datos de una cita

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/cita/update/rerum"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "paciente_id": 2,
    "fecha": "\"2020-05-23\"",
    "hora": "\"12:00\"",
    "aprovada": true,
    "respuesta": "null",
    "mensaje": "null"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 12,
    "medico_id": 1,
    "medico": {
        "id": 1,
        "nombre_completo": "katara caballero otsank",
        "direccion": "avensaida los angeles de charly",
        "ciudad": "parags222asuay",
        "celular": "4344436",
        "src_foto": "medico_1200610162742.jpg",
        "src_matricula": "medico_matricula_1200607141802.jpg",
        "player_id": "123123123",
        "user_id": 1,
        "created_at": "2020-06-04T21:21:16.000000Z",
        "updated_at": "2020-06-10T16:27:43.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
        "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
    },
    "paciente_id": 1,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "fecha": "2020-06-05",
    "hora": "06:00",
    "aprovada": true,
    "mensaje": null
}
```

### HTTP Request
`PUT api/cita/update/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de la cita
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `paciente_id` | integer |  required  | 
        `fecha` | date |  required  | 
        `hora` | time |  required  | 
        `aprovada` | boolean |  optional  | 
        `respuesta` | string |  optional  | 
        `mensaje` | string |  optional  | 
    
<!-- END_ed7d6157d1b4d8473953c4a520853417 -->

<!-- START_4e3b3735c42586753168d98c8c36e5d7 -->
## delete

Elimina una cita

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/cita/delete/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Eliminado correctamente"
```

### HTTP Request
`DELETE api/cita/delete/{id}`


<!-- END_4e3b3735c42586753168d98c8c36e5d7 -->

<!-- START_0d7e538f3355f243bf7304ad46ad0b4c -->
## restore

Restaura una cita eliminada

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/cita/restore/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Restaurado correctamente"
```

### HTTP Request
`DELETE api/cita/restore/{id}`


<!-- END_0d7e538f3355f243bf7304ad46ad0b4c -->

<!-- START_03e4912598259c94fb3992a2b47a93f3 -->
## reservar cita

Registra una nueva cita, este registro es echo por un usuario de tipo paciente,
Sacar el id del medico del recurso medico/list capturar el attriburto medico_id no
el is por que el id es el id de usuario solamente se debe capturar el medico_id es
el ue pertenece a la entidad medicos

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/cita/reservar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "medico_id": 1,
    "fecha": "\"2020-05-23\"",
    "hora": "\"12:00\"",
    "mensaje": "\"in need a consult\""
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 12,
    "medico_id": 1,
    "medico": {
        "id": 1,
        "nombre_completo": "katara caballero otsank",
        "direccion": "avensaida los angeles de charly",
        "ciudad": "parags222asuay",
        "celular": "4344436",
        "src_foto": "medico_1200610162742.jpg",
        "src_matricula": "medico_matricula_1200607141802.jpg",
        "player_id": "123123123",
        "user_id": 1,
        "created_at": "2020-06-04T21:21:16.000000Z",
        "updated_at": "2020-06-10T16:27:43.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
        "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
    },
    "paciente_id": 1,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "fecha": "2020-06-05",
    "hora": "06:00",
    "aprovada": false,
    "mensaje": "in need a consult"
}
```

### HTTP Request
`POST api/cita/reservar`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `medico_id` | integer |  required  | id del medico
        `fecha` | date |  required  | 
        `hora` | time |  required  | 
        `mensaje` | string |  optional  | 
    
<!-- END_03e4912598259c94fb3992a2b47a93f3 -->

<!-- START_847fcf72f8f5b855a6e8dad85402fc27 -->
## aprobar

Cambia el estado de aprovada a true, esto debe
realizarse por un usuario detipo medico

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/cita/aprobar/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 12,
    "medico_id": 1,
    "medico": {
        "id": 1,
        "nombre_completo": "katara caballero otsank",
        "direccion": "avensaida los angeles de charly",
        "ciudad": "parags222asuay",
        "celular": "4344436",
        "src_foto": "medico_1200610162742.jpg",
        "src_matricula": "medico_matricula_1200607141802.jpg",
        "player_id": "123123123",
        "user_id": 1,
        "created_at": "2020-06-04T21:21:16.000000Z",
        "updated_at": "2020-06-10T16:27:43.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
        "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
    },
    "paciente_id": 1,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "fecha": "2020-06-05",
    "hora": "06:00",
    "aprovada": true,
    "mensaje": null
}
```

### HTTP Request
`PATCH api/cita/aprobar/{id}`


<!-- END_847fcf72f8f5b855a6e8dad85402fc27 -->

#Compra


Una compra puede registrarse por un paciente 
y cambiarse de estado en el panel administrativo
<!-- START_43c0145b9b90f17e264a4193c560c460 -->
## create

registra una nueva compra. Solo un usuario de tipo paciente puede registrar una compra.
El tipo de pedido es numerico 1 = 'TIPO_CONTRA_ENTREGA' tipo 2 = TIPO_TRANSACION(con baucher)
Medicamento = {
     "medicamento_id":1,
     "cantidad":2,
}

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "observacion": "\"\"",
    "direccion": "mi \"direcccion actual\"",
    "latittude": "\"-79787978979\"",
    "longitude": "\"-4567899999\"",
    "tipo": 1,
    "detalle": "dignissimos",
    "baucher": "rerum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 12,
    "paciente_id": 1,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "fecha": "2020-06-30",
    "hora": "12:39",
    "observacion": null,
    "src_estado": 0,
    "estado": "Pendiente",
    "direccion": "mi direccion",
    "latitude": "-79879789",
    "longitude": "-77879799",
    "src_tipo": "2",
    "tipo": "Transacción bancaria",
    "src_baucher": "baucher_12200630123937.jpg",
    "baucher": "http:\/\/pacientemedico.ds:998\/uploads\/baucher_12200630123937.jpg",
    "total": 40,
    "detalle": [
        {
            "id": 22,
            "compra_id": 12,
            "medicamento_id": 1,
            "cantidad": 2,
            "created_at": "2020-06-30T12:39:38.000000Z",
            "updated_at": "2020-06-30T12:39:38.000000Z",
            "deleted_at": null,
            "subtotal": 20,
            "medicamento": {
                "id": 1,
                "nombre": "paracetamol",
                "descripcion": "es una paracetmoru",
                "disponible": true,
                "src_foto": "medicamento_1200607124405.jpg",
                "precio": 10,
                "observacion": "descripcion del paracetamoru",
                "created_at": "2020-06-07T12:44:05.000000Z",
                "updated_at": "2020-06-07T13:23:17.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
            }
        },
        {
            "id": 23,
            "compra_id": 12,
            "medicamento_id": 1,
            "cantidad": 2,
            "created_at": "2020-06-30T12:39:38.000000Z",
            "updated_at": "2020-06-30T12:39:38.000000Z",
            "deleted_at": null,
            "subtotal": 20,
            "medicamento": {
                "id": 1,
                "nombre": "paracetamol",
                "descripcion": "es una paracetmoru",
                "disponible": true,
                "src_foto": "medicamento_1200607124405.jpg",
                "precio": 10,
                "observacion": "descripcion del paracetamoru",
                "created_at": "2020-06-07T12:44:05.000000Z",
                "updated_at": "2020-06-07T13:23:17.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
            }
        }
    ]
}
```

### HTTP Request
`POST api/compra/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `observacion` | string |  optional  | max 500
        `direccion` | string |  required  | 
        `latittude` | string |  required  | 
        `longitude` | string |  required  | 
        `tipo` | integer |  required  | 
        `detalle` | Array |  required  | array de medicamentos
        `baucher` | string |  optional  | base 64 string en base 64
    
<!-- END_43c0145b9b90f17e264a4193c560c460 -->

<!-- START_4e7614d51f08e4c5a366e9e89c8920ae -->
## lista de compras

muestra la lista de copmras registradas.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/list"
);

let params = {
    "page": "quam",
    "per_page": "est",
    "src_estado": "exercitationem",
    "paciente_id": "est",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 6,
            "paciente_id": 2,
            "paciente": {
                "id": 2,
                "nombre_completo": "adiana condory soto",
                "direccion": "calle principal entra las calles e oreo",
                "ciudad": "cochabamba",
                "celular": "78998777",
                "src_foto": "paciente_12200608094614.jpg",
                "player_id": "123123123",
                "user_id": 12,
                "created_at": "2020-06-08T09:46:14.000000Z",
                "updated_at": "2020-06-08T12:13:46.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
            },
            "fecha": "2020-06-08",
            "hora": "12:44",
            "observacion": "quiero mi pedido de imediato prque sin no ya veras tu toma, y la proxima te va pior",
            "entregado": false,
            "pendiente": true,
            "total": 45,
            "detalle": [
                {
                    "id": 10,
                    "compra_id": 6,
                    "medicamento_id": 1,
                    "cantidad": 2,
                    "created_at": "2020-06-08T12:44:12.000000Z",
                    "updated_at": "2020-06-08T12:44:12.000000Z",
                    "deleted_at": null,
                    "subtotal": 20,
                    "medicamento": {
                        "id": 1,
                        "nombre": "paracetamol",
                        "descripcion": "es una paracetmoru",
                        "disponible": true,
                        "src_foto": "medicamento_1200607124405.jpg",
                        "precio": 10,
                        "observacion": "descripcion del paracetamoru",
                        "created_at": "2020-06-07T12:44:05.000000Z",
                        "updated_at": "2020-06-07T13:23:17.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                    }
                },
                {
                    "id": 11,
                    "compra_id": 6,
                    "medicamento_id": 2,
                    "cantidad": 5,
                    "created_at": "2020-06-08T12:44:12.000000Z",
                    "updated_at": "2020-06-08T12:44:12.000000Z",
                    "deleted_at": null,
                    "subtotal": 25,
                    "medicamento": {
                        "id": 2,
                        "nombre": "arovarbol",
                        "descripcion": "descripcion del medicamento",
                        "disponible": true,
                        "src_foto": "medicamento_2200609172456.jpg",
                        "precio": 5,
                        "observacion": "obsrvacion del medicamento",
                        "created_at": "2020-06-08T09:16:56.000000Z",
                        "updated_at": "2020-06-09T17:24:56.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                    }
                }
            ]
        }
    ],
    "current_page": "1",
    "per_page": "5",
    "total": 2
}
```

### HTTP Request
`GET api/compra/list`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `src_estado` |  required  | estado de la compra
    `paciente_id` |  optional  | es el id del paciente

<!-- END_4e7614d51f08e4c5a366e9e89c8920ae -->

<!-- START_9315885783b8e07f622e87d10a280300 -->
## show

Muestra los datos de una compra.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/show/fuga"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 12,
    "paciente_id": 2,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "fecha": "2020-06-05",
    "hora": "06:00",
    "observacion": "ninguna",
    "pendiente": true,
    "entregado": false,
    "total": 45,
    "detalle": [
        {
            "id": 10,
            "compra_id": 6,
            "medicamento_id": 1,
            "cantidad": 2,
            "created_at": "2020-06-08T12:44:12.000000Z",
            "updated_at": "2020-06-08T12:44:12.000000Z",
            "deleted_at": null,
            "subtotal": 20,
            "medicamento": {
                "id": 1,
                "nombre": "paracetamol",
                "descripcion": "es una paracetmoru",
                "disponible": true,
                "src_foto": "medicamento_1200607124405.jpg",
                "precio": 10,
                "observacion": "descripcion del paracetamoru",
                "created_at": "2020-06-07T12:44:05.000000Z",
                "updated_at": "2020-06-07T13:23:17.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
            }
        },
        {
            "id": 11,
            "compra_id": 6,
            "medicamento_id": 2,
            "cantidad": 5,
            "created_at": "2020-06-08T12:44:12.000000Z",
            "updated_at": "2020-06-08T12:44:12.000000Z",
            "deleted_at": null,
            "subtotal": 25,
            "medicamento": {
                "id": 2,
                "nombre": "arovarbol",
                "descripcion": "descripcion del medicamento",
                "disponible": true,
                "src_foto": "medicamento_2200609172456.jpg",
                "precio": 5,
                "observacion": "obsrvacion del medicamento",
                "created_at": "2020-06-08T09:16:56.000000Z",
                "updated_at": "2020-06-09T17:24:56.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
            }
        }
    ]
}
```

### HTTP Request
`GET api/compra/show/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de la copmra

<!-- END_9315885783b8e07f622e87d10a280300 -->

<!-- START_193a83a234648383f19d4219e273283c -->
## update

modifica una compra.

Medicamento = {
     "id":3,
     "medicamento_id":1,
     "cantidad":2
}

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/update/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "paciente_id": 11,
    "fecha": "aut",
    "hora": "placeat",
    "entregado": true,
    "pendiente": false
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 12,
    "paciente_id": 2,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "fecha": "2020-06-05",
    "hora": "06:00",
    "observacion": "ninguna",
    "pendiente": true,
    "entregado": false,
    "total": 45,
    "detalle": [
        {
            "id": 10,
            "compra_id": 6,
            "medicamento_id": 1,
            "cantidad": 2,
            "created_at": "2020-06-08T12:44:12.000000Z",
            "updated_at": "2020-06-08T12:44:12.000000Z",
            "deleted_at": null,
            "subtotal": 20,
            "medicamento": {
                "id": 1,
                "nombre": "paracetamol",
                "descripcion": "es una paracetmoru",
                "disponible": true,
                "src_foto": "medicamento_1200607124405.jpg",
                "precio": 10,
                "observacion": "descripcion del paracetamoru",
                "created_at": "2020-06-07T12:44:05.000000Z",
                "updated_at": "2020-06-07T13:23:17.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
            }
        },
        {
            "id": 11,
            "compra_id": 6,
            "medicamento_id": 2,
            "cantidad": 5,
            "created_at": "2020-06-08T12:44:12.000000Z",
            "updated_at": "2020-06-08T12:44:12.000000Z",
            "deleted_at": null,
            "subtotal": 25,
            "medicamento": {
                "id": 2,
                "nombre": "arovarbol",
                "descripcion": "descripcion del medicamento",
                "disponible": true,
                "src_foto": "medicamento_2200609172456.jpg",
                "precio": 5,
                "observacion": "obsrvacion del medicamento",
                "created_at": "2020-06-08T09:16:56.000000Z",
                "updated_at": "2020-06-09T17:24:56.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
            }
        }
    ]
}
```

### HTTP Request
`PUT api/compra/update/{id}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `paciente_id` | integer |  required  | 
        `fecha` | date |  required  | 
        `hora` | time |  required  | 
        `entregado` | boolean |  required  | 
        `pendiente` | boolean |  required  | tambien llamaro atendido para
    
<!-- END_193a83a234648383f19d4219e273283c -->

<!-- START_83fa0611b334432e518bce18b8815615 -->
## delete

Elimina una compra registrada.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/delete/consequatur"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Eliminado correctamente"
```

### HTTP Request
`DELETE api/compra/delete/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de la compra

<!-- END_83fa0611b334432e518bce18b8815615 -->

<!-- START_d602a4455b635442eae4b2f2049f9369 -->
## restore

Restaura una compra eliminada.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/restore/eos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Restaurado correctamente"
```

### HTTP Request
`DELETE api/compra/restore/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de la compra

<!-- END_d602a4455b635442eae4b2f2049f9369 -->

<!-- START_2d4a8956ce93c6e09ba2fbc8a0e20eca -->
## entregado

Cambiar de estado de la compra a entregado.
previamente la copmra ya debe de estar en estado = entregado.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/entregado/debitis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Compra entregada",
    "compra": {
        "id": 6,
        "paciente_id": 2,
        "paciente": {
            "id": 2,
            "nombre_completo": "adiana condory soto",
            "direccion": "calle principal entra las calles e oreo",
            "ciudad": "cochabamba",
            "celular": "78998777",
            "src_foto": "paciente_12200608094614.jpg",
            "player_id": "123123123",
            "user_id": 12,
            "created_at": "2020-06-08T09:46:14.000000Z",
            "updated_at": "2020-06-08T12:13:46.000000Z",
            "deleted_at": null,
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
        },
        "fecha": "2020-06-08",
        "hora": "12:44",
        "observacion": "quiero mi pedido de imediato prque sin no ya veras tu toma, y la proxima te va pior",
        "src_estado": 2,
        "total": 45,
        "detalle": [
            {
                "id": 10,
                "compra_id": 6,
                "medicamento_id": 1,
                "cantidad": 2,
                "created_at": "2020-06-08T12:44:12.000000Z",
                "updated_at": "2020-06-08T12:44:12.000000Z",
                "deleted_at": null,
                "subtotal": 20,
                "medicamento": {
                    "id": 1,
                    "nombre": "paracetamol",
                    "descripcion": "es una paracetmoru",
                    "disponible": true,
                    "src_foto": "medicamento_1200607124405.jpg",
                    "precio": 10,
                    "observacion": "descripcion del paracetamoru",
                    "created_at": "2020-06-07T12:44:05.000000Z",
                    "updated_at": "2020-06-07T13:23:17.000000Z",
                    "deleted_at": null,
                    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                }
            },
            {
                "id": 11,
                "compra_id": 6,
                "medicamento_id": 2,
                "cantidad": 5,
                "created_at": "2020-06-08T12:44:12.000000Z",
                "updated_at": "2020-06-08T12:44:12.000000Z",
                "deleted_at": null,
                "subtotal": 25,
                "medicamento": {
                    "id": 2,
                    "nombre": "arovarbol",
                    "descripcion": "descripcion del medicamento",
                    "disponible": true,
                    "src_foto": "medicamento_2200609172456.jpg",
                    "precio": 5,
                    "observacion": "obsrvacion del medicamento",
                    "created_at": "2020-06-08T09:16:56.000000Z",
                    "updated_at": "2020-06-09T17:24:56.000000Z",
                    "deleted_at": null,
                    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                }
            }
        ]
    }
}
```

### HTTP Request
`PATCH api/compra/entregado/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | requiered id de la compra

<!-- END_2d4a8956ce93c6e09ba2fbc8a0e20eca -->

<!-- START_7cb6228307d500eb59b454089b495953 -->
## atendido

Cambiar de estado de la compra estado=atendido.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/atendido/repellendus"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Compra atendida",
    "compra": {
        "id": 6,
        "paciente_id": 2,
        "paciente": {
            "id": 2,
            "nombre_completo": "adiana condory soto",
            "direccion": "calle principal entra las calles e oreo",
            "ciudad": "cochabamba",
            "celular": "78998777",
            "src_foto": "paciente_12200608094614.jpg",
            "player_id": "123123123",
            "user_id": 12,
            "created_at": "2020-06-08T09:46:14.000000Z",
            "updated_at": "2020-06-08T12:13:46.000000Z",
            "deleted_at": null,
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
        },
        "fecha": "2020-06-08",
        "hora": "12:44",
        "observacion": "quiero mi pedido de imediato prque sin no ya veras tu toma, y la proxima te va pior",
        "src_estado": 1,
        "total": 45,
        "detalle": [
            {
                "id": 10,
                "compra_id": 6,
                "medicamento_id": 1,
                "cantidad": 2,
                "created_at": "2020-06-08T12:44:12.000000Z",
                "updated_at": "2020-06-08T12:44:12.000000Z",
                "deleted_at": null,
                "subtotal": 20,
                "medicamento": {
                    "id": 1,
                    "nombre": "paracetamol",
                    "descripcion": "es una paracetmoru",
                    "disponible": true,
                    "src_foto": "medicamento_1200607124405.jpg",
                    "precio": 10,
                    "observacion": "descripcion del paracetamoru",
                    "created_at": "2020-06-07T12:44:05.000000Z",
                    "updated_at": "2020-06-07T13:23:17.000000Z",
                    "deleted_at": null,
                    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                }
            },
            {
                "id": 11,
                "compra_id": 6,
                "medicamento_id": 2,
                "cantidad": 5,
                "created_at": "2020-06-08T12:44:12.000000Z",
                "updated_at": "2020-06-08T12:44:12.000000Z",
                "deleted_at": null,
                "subtotal": 25,
                "medicamento": {
                    "id": 2,
                    "nombre": "arovarbol",
                    "descripcion": "descripcion del medicamento",
                    "disponible": true,
                    "src_foto": "medicamento_2200609172456.jpg",
                    "precio": 5,
                    "observacion": "obsrvacion del medicamento",
                    "created_at": "2020-06-08T09:16:56.000000Z",
                    "updated_at": "2020-06-09T17:24:56.000000Z",
                    "deleted_at": null,
                    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                }
            }
        ]
    }
}
```

### HTTP Request
`PATCH api/compra/atendido/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | requiered id de la compra

<!-- END_7cb6228307d500eb59b454089b495953 -->

<!-- START_09f48130b7b1fcdf8b4e0d42d5a1aa51 -->
## revertir entregado

Cambiar de estado de la compra estado = atendido.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/entregado-revert/perspiciatis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Revertido",
    "compra": {
        "id": 6,
        "paciente_id": 2,
        "paciente": {
            "id": 2,
            "nombre_completo": "adiana condory soto",
            "direccion": "calle principal entra las calles e oreo",
            "ciudad": "cochabamba",
            "celular": "78998777",
            "src_foto": "paciente_12200608094614.jpg",
            "player_id": "123123123",
            "user_id": 12,
            "created_at": "2020-06-08T09:46:14.000000Z",
            "updated_at": "2020-06-08T12:13:46.000000Z",
            "deleted_at": null,
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
        },
        "fecha": "2020-06-08",
        "hora": "12:44",
        "observacion": "quiero mi pedido de imediato prque sin no ya veras tu toma, y la proxima te va pior",
        "src_estado": 1,
        "total": 45,
        "detalle": [
            {
                "id": 10,
                "compra_id": 6,
                "medicamento_id": 1,
                "cantidad": 2,
                "created_at": "2020-06-08T12:44:12.000000Z",
                "updated_at": "2020-06-08T12:44:12.000000Z",
                "deleted_at": null,
                "subtotal": 20,
                "medicamento": {
                    "id": 1,
                    "nombre": "paracetamol",
                    "descripcion": "es una paracetmoru",
                    "disponible": true,
                    "src_foto": "medicamento_1200607124405.jpg",
                    "precio": 10,
                    "observacion": "descripcion del paracetamoru",
                    "created_at": "2020-06-07T12:44:05.000000Z",
                    "updated_at": "2020-06-07T13:23:17.000000Z",
                    "deleted_at": null,
                    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                }
            },
            {
                "id": 11,
                "compra_id": 6,
                "medicamento_id": 2,
                "cantidad": 5,
                "created_at": "2020-06-08T12:44:12.000000Z",
                "updated_at": "2020-06-08T12:44:12.000000Z",
                "deleted_at": null,
                "subtotal": 25,
                "medicamento": {
                    "id": 2,
                    "nombre": "arovarbol",
                    "descripcion": "descripcion del medicamento",
                    "disponible": true,
                    "src_foto": "medicamento_2200609172456.jpg",
                    "precio": 5,
                    "observacion": "obsrvacion del medicamento",
                    "created_at": "2020-06-08T09:16:56.000000Z",
                    "updated_at": "2020-06-09T17:24:56.000000Z",
                    "deleted_at": null,
                    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                }
            }
        ]
    }
}
```

### HTTP Request
`PATCH api/compra/entregado-revert/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | requiered id de la compra

<!-- END_09f48130b7b1fcdf8b4e0d42d5a1aa51 -->

<!-- START_e2d24052cd6f724109b7c2c726017470 -->
## revertir atendido

Cambiar de estado de la compra estado = pendiente.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/compra/atendido-revert/eum"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Revertido",
    "compra": {
        "id": 6,
        "paciente_id": 2,
        "paciente": {
            "id": 2,
            "nombre_completo": "adiana condory soto",
            "direccion": "calle principal entra las calles e oreo",
            "ciudad": "cochabamba",
            "celular": "78998777",
            "src_foto": "paciente_12200608094614.jpg",
            "player_id": "123123123",
            "user_id": 12,
            "created_at": "2020-06-08T09:46:14.000000Z",
            "updated_at": "2020-06-08T12:13:46.000000Z",
            "deleted_at": null,
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
        },
        "fecha": "2020-06-08",
        "hora": "12:44",
        "observacion": "quiero mi pedido de imediato prque sin no ya veras tu toma, y la proxima te va pior",
        "src_estado": 0,
        "total": 45,
        "detalle": [
            {
                "id": 10,
                "compra_id": 6,
                "medicamento_id": 1,
                "cantidad": 2,
                "created_at": "2020-06-08T12:44:12.000000Z",
                "updated_at": "2020-06-08T12:44:12.000000Z",
                "deleted_at": null,
                "subtotal": 20,
                "medicamento": {
                    "id": 1,
                    "nombre": "paracetamol",
                    "descripcion": "es una paracetmoru",
                    "disponible": true,
                    "src_foto": "medicamento_1200607124405.jpg",
                    "precio": 10,
                    "observacion": "descripcion del paracetamoru",
                    "created_at": "2020-06-07T12:44:05.000000Z",
                    "updated_at": "2020-06-07T13:23:17.000000Z",
                    "deleted_at": null,
                    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                }
            },
            {
                "id": 11,
                "compra_id": 6,
                "medicamento_id": 2,
                "cantidad": 5,
                "created_at": "2020-06-08T12:44:12.000000Z",
                "updated_at": "2020-06-08T12:44:12.000000Z",
                "deleted_at": null,
                "subtotal": 25,
                "medicamento": {
                    "id": 2,
                    "nombre": "arovarbol",
                    "descripcion": "descripcion del medicamento",
                    "disponible": true,
                    "src_foto": "medicamento_2200609172456.jpg",
                    "precio": 5,
                    "observacion": "obsrvacion del medicamento",
                    "created_at": "2020-06-08T09:16:56.000000Z",
                    "updated_at": "2020-06-09T17:24:56.000000Z",
                    "deleted_at": null,
                    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                }
            }
        ]
    }
}
```

### HTTP Request
`PATCH api/compra/atendido-revert/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | requiered id de la compra

<!-- END_e2d24052cd6f724109b7c2c726017470 -->

#Login


Autentifica usuarios de tipo adminitrador, paciente y medico
<!-- START_e9aa8e9cecac4d07efa45f1b2d470efb -->
## Login admin (public)

Autentifica un usuario de tipo administrador.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "waldo@waldo.com",
    "password": "waldo123123"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 18,
    "nombre_completo": "waldo",
    "email": "waldo@waldo.com",
    "foto": null,
    "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZGQwNjgyZWYxYWI0ZGM1YzQ4OWYzODI2OWMyM2FiOTU1ODZlMGFiNmUyYmE0NzQ4OWJmMzVkNjBmY2M5ZTMxZjAxMTExMmM2YWFjYzVmODUiLCJpYXQiOjE1OTIzNDgxNTYsIm5iZiI6MTU5MjM0ODE1NiwiZXhwIjoxNjIzODg0MTU2LCJzdWIiOiIxOCIsInNjb3BlcyI6W119.S1KBVVN7UzSxzJ0G16vr592GgiRjD8P4m8n_LLrm5jyeLJHNxvf7ImenYX2f5SzbrZk4WgSmnbVg7JsQnQ-mCDdCRCsfcpql6EjPPlxnDdDQ5JbkkoRMMd874feVAlTubiKvlhod6-z4edFkz79fzPO9sTBQzCR9MbxVz9rDQ0VXRLrjnk4I_Xqrevgmp55RZVzJRg9MSV0yCboMGMzIjMTo28p1AhgejN0aSFRlVYzUjasjLIVu7MQohwD6ya2U2hugRajvAWrMemWqB0CHfNAXwvfhxyd9_jGAjRs5SNeZjL2SpVQCNTd6lhfQ6AKVGEsDt0MOFGubhfAQzG5VyFB33yTxGLL2-JegSiuk-EKZ18J-egQMgExexfFNapJmoPRKzRzgW3Q7Y8zcME9SIM18um-Kf1UNvcqhhAz5XqG96UHcJzxETo9xnC0EPR9560ycy4Gwc171DP1zn6vrlZWGonmCFT8MSExB3spK1g9koyg74XgF-DqW4KdSdHpyUBRWmxFzKA1RLoqKWuK5d0AbHB9fbosNWgSXwwB8loN6Bd7Fhgfp3Ke9JG7Ajc3-lOvV1o3qoUZEW-83cGNIZeElu-shUWuxe428le3Ckxwi2HUjW6f-DMbSWfBZBOcqQfrJhZmsOHy4ekMcPWH60fF3OROZH5M62rksOKRi94w"
}
```
> Example response (200):

```json
{
    "id": 18,
    "nombre_completo": "waldo",
    "email": "waldo@waldo.com",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg",
    "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZGQwNjgyZWYxYWI0ZGM1YzQ4OWYzODI2OWMyM2FiOTU1ODZlMGFiNmUyYmE0NzQ4OWJmMzVkNjBmY2M5ZTMxZjAxMTExMmM2YWFjYzVmODUiLCJpYXQiOjE1OTIzNDgxNTYsIm5iZiI6MTU5MjM0ODE1NiwiZXhwIjoxNjIzODg0MTU2LCJzdWIiOiIxOCIsInNjb3BlcyI6W119.S1KBVVN7UzSxzJ0G16vr592GgiRjD8P4m8n_LLrm5jyeLJHNxvf7ImenYX2f5SzbrZk4WgSmnbVg7JsQnQ-mCDdCRCsfcpql6EjPPlxnDdDQ5JbkkoRMMd874feVAlTubiKvlhod6-z4edFkz79fzPO9sTBQzCR9MbxVz9rDQ0VXRLrjnk4I_Xqrevgmp55RZVzJRg9MSV0yCboMGMzIjMTo28p1AhgejN0aSFRlVYzUjasjLIVu7MQohwD6ya2U2hugRajvAWrMemWqB0CHfNAXwvfhxyd9_jGAjRs5SNeZjL2SpVQCNTd6lhfQ6AKVGEsDt0MOFGubhfAQzG5VyFB33yTxGLL2-JegSiuk-EKZ18J-egQMgExexfFNapJmoPRKzRzgW3Q7Y8zcME9SIM18um-Kf1UNvcqhhAz5XqG96UHcJzxETo9xnC0EPR9560ycy4Gwc171DP1zn6vrlZWGonmCFT8MSExB3spK1g9koyg74XgF-DqW4KdSdHpyUBRWmxFzKA1RLoqKWuK5d0AbHB9fbosNWgSXwwB8loN6Bd7Fhgfp3Ke9JG7Ajc3-lOvV1o3qoUZEW-83cGNIZeElu-shUWuxe428le3Ckxwi2HUjW6f-DMbSWfBZBOcqQfrJhZmsOHy4ekMcPWH60fF3OROZH5M62rksOKRi94w"
}
```
> Example response (403):

```json
{
    "message": "Email o contraseña incorrectos"
}
```

### HTTP Request
`POST api/admin/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | 
        `password` | string |  required  | 
    
<!-- END_e9aa8e9cecac4d07efa45f1b2d470efb -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## Login paciente | medico (public)

Autentifica un Paciente o Medico.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "email@email.com",
    "password": "123123213",
    "player_id": "playerIDfs123123213fds fds fd"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 12,
    "email": "email@mail.com",
    "type": 2,
    "paciente_id": 2,
    "nombre_completo": "nombre_completo",
    "ciudad": "ciudad",
    "direccion": "direccion blablaa",
    "celular": 2432432,
    "player_id": "player_idds ds dsd sdsadas dsa",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg",
    "accessToken": "accessToken 34243423432"
}
```
> Example response (200):

```json
{
    "id": 12,
    "email": "email@mail.com",
    "type": 2,
    "medico_id": 3,
    "nombre_completo": "nombre_completo",
    "ciudad": "ciudad",
    "direccion": "direccion blablaa",
    "celular": 2432432,
    "player_id": "player_idds ds dsd sdsadas dsa",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg",
    "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg",
    "accessToken": "accessToken 34243423432"
}
```
> Example response (403):

```json
{
    "message": "Email o contraseña incorrectos"
}
```

### HTTP Request
`POST api/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | 
        `password` | string |  required  | 
        `player_id` | string |  required  | 
    
<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

#Medicamento


Un medicamento puede listarse, mostrarse, modificarse, 
eliminarse y restaurarse
<!-- START_3c33873bbd28e022e3e7d4d71c1049fa -->
## create

Registra un nuevo medicamento.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medicamento/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "nombre": "\"pentaricela\"",
    "precio": "12",
    "descripcion": "\"pentaricela varicela de 12 gm\"",
    "observacion": "\"es un emdicamento usado para calmar el mal estar de la ira\"",
    "foto": "\"data:image\/jpeg;base64,\/9j\/4AAQSkZJRgABAQAAAQABAAD\/\""
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 4,
    "nombre": "pentaricela",
    "descripcion": "pentaricela varicela de 12 gm",
    "disponible": true,
    "strDisponible": "Si",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_4200617134449.jpg",
    "precio": 12,
    "observacion": "es un emdicamento usado para calmar el mal estar de la ira"
}
```

### HTTP Request
`POST api/medicamento/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nombre` | string |  required  | 
        `precio` | string |  required  | 
        `descripcion` | string |  required  | 
        `observacion` | string |  optional  | 
        `foto` | string |  optional  | 
    
<!-- END_3c33873bbd28e022e3e7d4d71c1049fa -->

<!-- START_86c410c663980884ba3b40ed03369b0f -->
## list

Muestra la lista de medicamentos.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medicamento/list"
);

let params = {
    "page": "ut",
    "per_page": "dolorem",
    "filter": "perspiciatis",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "nombre": "paracetamol",
            "descripcion": "es una paracetmoru",
            "disponible": true,
            "src_foto": "medicamento_1200607124405.jpg",
            "precio": 10,
            "observacion": "descripcion del paracetamoru",
            "created_at": "2020-06-07T12:44:05.000000Z",
            "updated_at": "2020-06-07T13:23:17.000000Z",
            "deleted_at": null,
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
        },
        {
            "id": 2,
            "nombre": "arovarbol",
            "descripcion": "descripcion del medicamento",
            "disponible": true,
            "src_foto": "medicamento_2200609172456.jpg",
            "precio": 5,
            "observacion": "obsrvacion del medicamento",
            "created_at": "2020-06-08T09:16:56.000000Z",
            "updated_at": "2020-06-09T17:24:56.000000Z",
            "deleted_at": null,
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
        }
    ],
    "first_page_url": "http:\/\/pacientemedico.ds:998\/api\/medicamento\/list?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http:\/\/pacientemedico.ds:998\/api\/medicamento\/list?page=1",
    "next_page_url": null,
    "path": "http:\/\/pacientemedico.ds:998\/api\/medicamento\/list",
    "per_page": "5",
    "prev_page_url": null,
    "to": 3,
    "total": 3
}
```

### HTTP Request
`GET api/medicamento/list`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con disponible, nombre, descripcion y precio

<!-- END_86c410c663980884ba3b40ed03369b0f -->

<!-- START_3cf6c55eff2708c6c2a7e95d8eb36c03 -->
## show

Muestra los datos de un medicamento.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medicamento/show/magni"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 1,
    "nombre": "paracetamol",
    "descripcion": "es una paracetmoru",
    "disponible": true,
    "strDisponible": "Si",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg",
    "precio": 10,
    "observacion": "descripcion del paracetamoru",
    "fotografia": null
}
```

### HTTP Request
`GET api/medicamento/show/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id del medicamento

<!-- END_3cf6c55eff2708c6c2a7e95d8eb36c03 -->

<!-- START_954e9564034aa8debb880754140c71b0 -->
## update

Modifica los datos de un medicamento.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medicamento/update/provident"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "nombre": "\"pentaricela\"",
    "precio": "12",
    "descripcion": "\"pentaricela varicela de 12 gm\"",
    "observacion": "\"es un emdicamento usado para calmar el mal estar de la ira\"",
    "foto": "null"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 4,
    "nombre": "pentaricela",
    "descripcion": "pentaricela varicela de 12 gm",
    "disponible": true,
    "strDisponible": "Si",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_4200617134449.jpg",
    "precio": 12,
    "observacion": "es un emdicamento usado para calmar el mal estar de la ira"
}
```

### HTTP Request
`PUT api/medicamento/update/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id del medicamento.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nombre` | string |  required  | 
        `precio` | string |  required  | 
        `descripcion` | string |  required  | 
        `observacion` | string |  optional  | 
        `foto` | string |  optional  | 
    
<!-- END_954e9564034aa8debb880754140c71b0 -->

<!-- START_50a2a85dee51245c35820e4119fb84f5 -->
## delete

Elimina un medicamento.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medicamento/delete/nihil"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Eliminado correctamente"
```

### HTTP Request
`DELETE api/medicamento/delete/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id del medicamento

<!-- END_50a2a85dee51245c35820e4119fb84f5 -->

<!-- START_bd6abb2f16ef0d27c64dd63bd394b27c -->
## restore

Restaura un medicamento eliminado.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medicamento/restore/architecto"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Restaurado correctamente"
```

### HTTP Request
`DELETE api/medicamento/restore/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id del medicamento

<!-- END_bd6abb2f16ef0d27c64dd63bd394b27c -->

#Medico


un medico puede ver y crear recetas y citas
<!-- START_627f9c00ea9852bb63720e70dfdcfbeb -->
## create

creaer un nuevo medico.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "nombre_completo": "\"opal long feng\"",
    "email": "\"opal@gmail.com\"",
    "ciudad": "\"templeo del aire norte\"",
    "direccion": "\"ciudad republica \"",
    "celular": "7897899",
    "player_id": "\"ninguno\"",
    "foto": "\"data:image\/jpeg;base64,\/9j\/4AAQSkZJRgABAQAAAQABAAD\/\"",
    "matricula": "\"data:image\/png;base64,=\"",
    "password": "\"123123123\""
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 19,
    "email": "opal@gmail.com",
    "type": 3,
    "medico_id": 5,
    "nombre_completo": "opal long feng",
    "ciudad": "templeo del aire norte",
    "direccion": "ciudad republica",
    "celular": "7897899",
    "player_id": "ninguno",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_19200617130947.jpg",
    "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_19200617130947.jpg",
    "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTk3NDY2NGEwNjg5ZWMwZWM0MTg2YWNiNDU4NjY3ZTE4YmMzNWJjMTNhNDUwMTBmM2M3YTJkYWE4Zjg4MzkyNWZjMjcwOGEwZDA4YjA5NTQiLCJpYXQiOjE1OTIzOTkzODgsIm5iZiI6MTU5MjM5OTM4OCwiZXhwIjoxNjIzOTM1Mzg4LCJzdWIiOiIxOSIsInNjb3BlcyI6W119.hrqMpVZ2DkxMdIADTl5oj3D5ps9A5pcOLHCbNcOw0NxQnqkfqzjCHvpqfzC5xnYyeAtvNmimy3BknUagTVDpW84cUIQnzjomeBWb1zQFfDlgP4EfCMGjtxJZSIpRG9scuAbVG3gsQu9_7sdRmfTymElMvC126Tb7Inm9zWG4fO4D_9dAPhSyPHlBu2E1bsZoDywR72Y4eVgduNxcW28X9sbuhB1MruCNZx9TAzzz5nvGR6S9lkgMTJ6t119y7aBRJxd1hQDE2fmDz6itsW1ZLCjnyh2FftOzBWJgj6zLo4-BhvtOOrXKo0Zz5u3XrQjJk6GfpRfKbWKYv501UMJUGkVBLpMJQ0--ssta8SyFNTAhh-keRxb3ZceSAfbFc-CPUrFik8jU-OEwsOsxftjUdDrr4OfeSc-a98BfPukMgi4wS1r7gBKLkpJQTt0ZQRUWm5u50Sdu60kihZOFMJXhEQiLi2xaVOms4lO-yH64_Z2c9JEVFhyNU9XDWVbCJYJU3Lz8OONbQPh2WOfi0GWhxodPKoQ4dceVZJNx6dh4_H3xUDNEW6V5au_M1w_zuQyNL6XHxIetJak9M9jhsku-659cl-m7INpnY-gzL0mrmkgyNRTLGduUM8OTAa2CTqxZh3PpKI8CshPGbTCPOcV0_BzkfApGmk8QYW57x3qDUYw"
}
```

### HTTP Request
`POST api/medico/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nombre_completo` | string |  required  | max 50 caracteres
        `email` | email |  required  | 
        `ciudad` | string |  required  | max 50 caracteres
        `direccion` | string |  optional  | max 200 caracteres
        `celular` | string |  optional  | 
        `player_id` | string |  required  | 
        `foto` | string |  required  | string base 64
        `matricula` | string |  required  | string base 64
        `password` | string |  required  | 
    
<!-- END_627f9c00ea9852bb63720e70dfdcfbeb -->

<!-- START_6c8d808caaa4daa06d1a7dad30a64761 -->
## list

Muestra la lista de medicos.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/list"
);

let params = {
    "page": "vel",
    "per_page": "occaecati",
    "filter": "laborum",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "email": "katara@gmail.com",
            "type": 3,
            "medico_id": 1,
            "nombre_completo": "katara caballero otsank",
            "ciudad": "parags222asuay",
            "celular": "4344436",
            "direccion": "avensaida los angeles de charly",
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
            "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg",
            "admin": null,
            "paciente": null,
            "medico": {
                "id": 1,
                "nombre_completo": "katara caballero otsank",
                "direccion": "avensaida los angeles de charly",
                "ciudad": "parags222asuay",
                "celular": "4344436",
                "src_foto": "medico_1200610162742.jpg",
                "src_matricula": "medico_matricula_1200607141802.jpg",
                "player_id": "123123123",
                "user_id": 1,
                "created_at": "2020-06-04T21:21:16.000000Z",
                "updated_at": "2020-06-10T16:27:43.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
                "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
            }
        }
    ],
    "first_page_url": "http:\/\/pacientemedico.ds:998\/api\/medico\/list?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http:\/\/pacientemedico.ds:998\/api\/medico\/list?page=1",
    "next_page_url": null,
    "path": "http:\/\/pacientemedico.ds:998\/api\/medico\/list",
    "per_page": "5",
    "prev_page_url": null,
    "to": 4,
    "total": 4
}
```

### HTTP Request
`GET api/medico/list`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo, email y celular

<!-- END_6c8d808caaa4daa06d1a7dad30a64761 -->

<!-- START_4307d58da8c057bcffb6227aba30b5b4 -->
## show

Muestra los datos de un medico.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/show/odit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 1,
    "email": "katara@gmail.com",
    "type": 3,
    "medico_id": 1,
    "nombre_completo": "katara caballero otsank",
    "ciudad": "parags222asuay",
    "direccion": "avensaida los angeles de charly",
    "celular": "4344436",
    "player_id": "123123123",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
    "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg",
    "accessToken": null
}
```

### HTTP Request
`GET api/medico/show/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id del usuario

<!-- END_4307d58da8c057bcffb6227aba30b5b4 -->

<!-- START_37e714290f7df6ee522e70685590db5a -->
## update

Modifica los datos de un medico.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/update/ipsam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "nombre_completo": "\"opal long feng\"",
    "email": "\"opal@gmail.com\"",
    "ciudad": "\"templeo del aire norte\"",
    "direccion": "\"ciudad republica \"",
    "celular": "7897899",
    "foto": "\"data:image\/jpeg;base64,\/9j\/4AAQSkZJRgABAQAAAQABAAD\/\"",
    "matricula": "\"data:image\/png;base64,=\""
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 19,
    "email": "opal@gmail.com",
    "type": 3,
    "medico_id": 5,
    "nombre_completo": "opal long feng",
    "ciudad": "templeo del aire norte",
    "direccion": "ciudad republica",
    "celular": "7897899",
    "player_id": "ninguno",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_19200617130947.jpg",
    "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_19200617130947.jpg",
    "accessToken": null
}
```

### HTTP Request
`PUT api/medico/update/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id del usuario.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nombre_completo` | string |  required  | max 50 caracteres
        `email` | email |  required  | 
        `ciudad` | string |  required  | max 50 caracteres
        `direccion` | string |  optional  | max 200 caracteres
        `celular` | string |  required  | 
        `foto` | string |  optional  | string base 64
        `matricula` | string |  optional  | string base 64
    
<!-- END_37e714290f7df6ee522e70685590db5a -->

<!-- START_592d695efd02c5e71a60be48562f2cd5 -->
## mis pacientes

Muestra la lista de pacientes a los que
selecciona pra susu recetas medicas.
El id usuario es opcional de lo  contrario el
usuario se toamara atra vez del access token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/pacientes"
);

let params = {
    "page": "quas",
    "per_page": "unde",
    "filter": "ut",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "email": "quika@gmai.com",
            "user_id": 3,
            "nombre_completo": "Maria lorena chavez arce",
            "ciudad": "cochabamba",
            "direccion": "avenida los angeles numero 23",
            "celular": "789898988",
            "player_id": "123123123",
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 1
}
```

### HTTP Request
`GET api/medico/pacientes`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id del usuario.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_592d695efd02c5e71a60be48562f2cd5 -->

<!-- START_5b64bbca440ad6d30ff11f47f53b68f0 -->
## mis pacientes

Muestra la lista de pacientes a los que
selecciona pra susu recetas medicas.
El id usuario es opcional de lo  contrario el
usuario se toamara atra vez del access token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/pacientes/adipisci"
);

let params = {
    "page": "rerum",
    "per_page": "et",
    "filter": "dolor",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "email": "quika@gmai.com",
            "user_id": 3,
            "nombre_completo": "Maria lorena chavez arce",
            "ciudad": "cochabamba",
            "direccion": "avenida los angeles numero 23",
            "celular": "789898988",
            "player_id": "123123123",
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 1
}
```

### HTTP Request
`GET api/medico/pacientes/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id del usuario.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_5b64bbca440ad6d30ff11f47f53b68f0 -->

<!-- START_d698aef171d6b7993d7d3933c74c0eeb -->
## mis recetas

Muesra la lista de recetas del medico.
El id usuario es opcional de lo  contrario el
usuario se toamara atra vez del access token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/recetas"
);

let params = {
    "page": "harum",
    "per_page": "rem",
    "filter": "deleniti",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "medico_id": 1,
            "medico": {
                "id": 1,
                "nombre_completo": "katara caballero otsank",
                "direccion": "avensaida los angeles de charly",
                "ciudad": "parags222asuay",
                "celular": "4344436",
                "src_foto": "medico_1200610162742.jpg",
                "src_matricula": "medico_matricula_1200607141802.jpg",
                "player_id": "123123123",
                "user_id": 1,
                "created_at": "2020-06-04T21:21:16.000000Z",
                "updated_at": "2020-06-10T16:27:43.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
                "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
            },
            "paciente_id": 1,
            "paciente": {
                "id": 1,
                "nombre_completo": "Maria lorena chavez arce",
                "direccion": "avenida los angeles numero 23",
                "ciudad": "cochabamba",
                "celular": "789898988",
                "src_foto": "user_3200608171905.jpg",
                "player_id": "123123123",
                "user_id": 3,
                "created_at": "2020-06-05T21:08:09.000000Z",
                "updated_at": "2020-06-08T17:19:05.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
            },
            "fecha": "2020-06-05",
            "fecha_inicio": "2019-08-02",
            "fecha_fin": "2019-08-20",
            "observacion": null,
            "vigente": true,
            "medicamentos": [
                {
                    "id": 3,
                    "receta_id": 2,
                    "medicamento_id": 1,
                    "medida": "100 mg",
                    "medicamento": {
                        "id": 1,
                        "nombre": "paracetamol",
                        "descripcion": "es una paracetmoru",
                        "disponible": true,
                        "src_foto": "medicamento_1200607124405.jpg",
                        "precio": 10,
                        "observacion": "descripcion del paracetamoru",
                        "created_at": "2020-06-07T12:44:05.000000Z",
                        "updated_at": "2020-06-07T13:23:17.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                    },
                    "horas": [
                        "06:00",
                        "12:00",
                        "06:00"
                    ]
                },
                {
                    "id": 4,
                    "receta_id": 2,
                    "medicamento_id": 2,
                    "medida": "100 g",
                    "medicamento": {
                        "id": 2,
                        "nombre": "arovarbol",
                        "descripcion": "descripcion del medicamento",
                        "disponible": true,
                        "src_foto": "medicamento_2200609172456.jpg",
                        "precio": 5,
                        "observacion": "obsrvacion del medicamento",
                        "created_at": "2020-06-08T09:16:56.000000Z",
                        "updated_at": "2020-06-09T17:24:56.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                    },
                    "horas": [
                        "09:00",
                        "10:00",
                        "06:00"
                    ]
                },
                {
                    "id": 5,
                    "receta_id": 2,
                    "medicamento_id": 2,
                    "medida": "100 g",
                    "medicamento": {
                        "id": 2,
                        "nombre": "arovarbol",
                        "descripcion": "descripcion del medicamento",
                        "disponible": true,
                        "src_foto": "medicamento_2200609172456.jpg",
                        "precio": 5,
                        "observacion": "obsrvacion del medicamento",
                        "created_at": "2020-06-08T09:16:56.000000Z",
                        "updated_at": "2020-06-09T17:24:56.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                    },
                    "horas": [
                        "09:00",
                        "10:00",
                        "06:00"
                    ]
                }
            ]
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 6
}
```

### HTTP Request
`GET api/medico/recetas`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id del usuario.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_d698aef171d6b7993d7d3933c74c0eeb -->

<!-- START_59d23bc89f50b697ee51442c126adc8c -->
## mis recetas

Muesra la lista de recetas del medico.
El id usuario es opcional de lo  contrario el
usuario se toamara atra vez del access token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/recetas/quod"
);

let params = {
    "page": "architecto",
    "per_page": "commodi",
    "filter": "cumque",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "medico_id": 1,
            "medico": {
                "id": 1,
                "nombre_completo": "katara caballero otsank",
                "direccion": "avensaida los angeles de charly",
                "ciudad": "parags222asuay",
                "celular": "4344436",
                "src_foto": "medico_1200610162742.jpg",
                "src_matricula": "medico_matricula_1200607141802.jpg",
                "player_id": "123123123",
                "user_id": 1,
                "created_at": "2020-06-04T21:21:16.000000Z",
                "updated_at": "2020-06-10T16:27:43.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
                "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
            },
            "paciente_id": 1,
            "paciente": {
                "id": 1,
                "nombre_completo": "Maria lorena chavez arce",
                "direccion": "avenida los angeles numero 23",
                "ciudad": "cochabamba",
                "celular": "789898988",
                "src_foto": "user_3200608171905.jpg",
                "player_id": "123123123",
                "user_id": 3,
                "created_at": "2020-06-05T21:08:09.000000Z",
                "updated_at": "2020-06-08T17:19:05.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
            },
            "fecha": "2020-06-05",
            "fecha_inicio": "2019-08-02",
            "fecha_fin": "2019-08-20",
            "observacion": null,
            "vigente": true,
            "medicamentos": [
                {
                    "id": 3,
                    "receta_id": 2,
                    "medicamento_id": 1,
                    "medida": "100 mg",
                    "medicamento": {
                        "id": 1,
                        "nombre": "paracetamol",
                        "descripcion": "es una paracetmoru",
                        "disponible": true,
                        "src_foto": "medicamento_1200607124405.jpg",
                        "precio": 10,
                        "observacion": "descripcion del paracetamoru",
                        "created_at": "2020-06-07T12:44:05.000000Z",
                        "updated_at": "2020-06-07T13:23:17.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                    },
                    "horas": [
                        "06:00",
                        "12:00",
                        "06:00"
                    ]
                },
                {
                    "id": 4,
                    "receta_id": 2,
                    "medicamento_id": 2,
                    "medida": "100 g",
                    "medicamento": {
                        "id": 2,
                        "nombre": "arovarbol",
                        "descripcion": "descripcion del medicamento",
                        "disponible": true,
                        "src_foto": "medicamento_2200609172456.jpg",
                        "precio": 5,
                        "observacion": "obsrvacion del medicamento",
                        "created_at": "2020-06-08T09:16:56.000000Z",
                        "updated_at": "2020-06-09T17:24:56.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                    },
                    "horas": [
                        "09:00",
                        "10:00",
                        "06:00"
                    ]
                },
                {
                    "id": 5,
                    "receta_id": 2,
                    "medicamento_id": 2,
                    "medida": "100 g",
                    "medicamento": {
                        "id": 2,
                        "nombre": "arovarbol",
                        "descripcion": "descripcion del medicamento",
                        "disponible": true,
                        "src_foto": "medicamento_2200609172456.jpg",
                        "precio": 5,
                        "observacion": "obsrvacion del medicamento",
                        "created_at": "2020-06-08T09:16:56.000000Z",
                        "updated_at": "2020-06-09T17:24:56.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                    },
                    "horas": [
                        "09:00",
                        "10:00",
                        "06:00"
                    ]
                }
            ]
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 6
}
```

### HTTP Request
`GET api/medico/recetas/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id del usuario.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_59d23bc89f50b697ee51442c126adc8c -->

<!-- START_feffdb2f99ad32c586f58f72e8433290 -->
## mis citas

Muesra la lista de citas del medico.
El id usuario es opcional de lo  contrario el
usuario se toamara atra vez del access token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/citas"
);

let params = {
    "page": "veritatis",
    "per_page": "consequatur",
    "filter": "qui",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "medico_id": 1,
            "medico": {
                "id": 1,
                "nombre_completo": "katara caballero otsank",
                "direccion": "avensaida los angeles de charly",
                "ciudad": "parags222asuay",
                "celular": "4344436",
                "src_foto": "medico_1200610162742.jpg",
                "src_matricula": "medico_matricula_1200607141802.jpg",
                "player_id": "123123123",
                "user_id": 1,
                "created_at": "2020-06-04T21:21:16.000000Z",
                "updated_at": "2020-06-10T16:27:43.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
                "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
            },
            "paciente_id": 1,
            "paciente": {
                "id": 1,
                "nombre_completo": "Maria lorena chavez arce",
                "direccion": "avenida los angeles numero 23",
                "ciudad": "cochabamba",
                "celular": "789898988",
                "src_foto": "user_3200608171905.jpg",
                "player_id": "123123123",
                "user_id": 3,
                "created_at": "2020-06-05T21:08:09.000000Z",
                "updated_at": "2020-06-08T17:19:05.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
            },
            "fecha": "2020-05-04",
            "hora": "12:00:00",
            "aprovada": true,
            "pendiente": true,
            "mensaje": null
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 5
}
```

### HTTP Request
`GET api/medico/citas`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id del usuario.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_feffdb2f99ad32c586f58f72e8433290 -->

<!-- START_5b2f3fa747666358b9736590568c5165 -->
## mis citas

Muesra la lista de citas del medico.
El id usuario es opcional de lo  contrario el
usuario se toamara atra vez del access token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/citas/minus"
);

let params = {
    "page": "voluptatum",
    "per_page": "aut",
    "filter": "alias",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "medico_id": 1,
            "medico": {
                "id": 1,
                "nombre_completo": "katara caballero otsank",
                "direccion": "avensaida los angeles de charly",
                "ciudad": "parags222asuay",
                "celular": "4344436",
                "src_foto": "medico_1200610162742.jpg",
                "src_matricula": "medico_matricula_1200607141802.jpg",
                "player_id": "123123123",
                "user_id": 1,
                "created_at": "2020-06-04T21:21:16.000000Z",
                "updated_at": "2020-06-10T16:27:43.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
                "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
            },
            "paciente_id": 1,
            "paciente": {
                "id": 1,
                "nombre_completo": "Maria lorena chavez arce",
                "direccion": "avenida los angeles numero 23",
                "ciudad": "cochabamba",
                "celular": "789898988",
                "src_foto": "user_3200608171905.jpg",
                "player_id": "123123123",
                "user_id": 3,
                "created_at": "2020-06-05T21:08:09.000000Z",
                "updated_at": "2020-06-08T17:19:05.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
            },
            "fecha": "2020-05-04",
            "hora": "12:00:00",
            "aprovada": true,
            "pendiente": true,
            "mensaje": null
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 5
}
```

### HTTP Request
`GET api/medico/citas/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id del usuario.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_5b2f3fa747666358b9736590568c5165 -->

<!-- START_4839a7d7a8b820ea209c67ed7946d119 -->
## descripcion

Modifica el campo descripcion de medico.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/update-descripcion/voluptas"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "descripcion": "\"Medico cirujano Especialista en Oftalmolog\u00eda\""
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 19,
    "email": "opal@gmail.com",
    "type": 3,
    "medico_id": 5,
    "nombre_completo": "opal long feng",
    "ciudad": "templeo del aire norte",
    "direccion": "ciudad republica",
    "desctipcion": "Medico cirujano Especialista en Oftalmología",
    "celular": "7897899",
    "player_id": "ninguno",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_19200617130947.jpg",
    "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_19200617130947.jpg",
    "accessToken": null
}
```

### HTTP Request
`PATCH api/medico/update-descripcion/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id del usuario.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `descripcion` | string |  required  | max 500 caracteres
    
<!-- END_4839a7d7a8b820ea209c67ed7946d119 -->

#Paciente


un paciente puede ver y crear recetas, citas(con estado pendiente) y commpras
<!-- START_119b4ef3e3d4bef52c957390f740463a -->
## create paciente

Registra un nuevo paciente

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "nombre_completo": "numquam",
    "ciudad": "qui",
    "email": "autem",
    "password": "earum",
    "password_confirmation": "quam",
    "direccion": "quis",
    "celular": "vel",
    "player_id": "hic",
    "foto": "voluptas"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 3,
    "email": "quika@gmai.com",
    "type": 2,
    "paciente_id": 1,
    "nombre_completo": "Maria lorena chavez arce",
    "ciudad": "cochabamba",
    "direccion": "avenida los angeles numero 23",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg",
    "matricula": null,
    "admin": null,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "medico": null,
    "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTk3NDY2NGEwNjg5ZWMwZWM0MTg2YWNiNDU4NjY3ZTE4YmMzNWJjMTNhNDUwMTBmM2M3YTJkYWE4Zjg4MzkyNWZjMjcwOGEwZDA4YjA5NTQiLCJpYXQiOjE1OTIzOTkzODgsIm5iZiI6MTU5MjM5OTM4OCwiZXhwIjoxNjIzOTM1Mzg4LCJzdWIiOiIxOSIsInNjb3BlcyI6W119.hrqMpVZ2DkxMdIADTl5oj3D5ps9A5pcOLHCbNcOw0NxQnqkfqzjCHvpqfzC5xnYyeAtvNmimy3BknUagTVDpW84cUIQnzjomeBWb1zQFfDlgP4EfCMGjtxJZSIpRG9scuAbVG3gsQu9_7sdRmfTymElMvC126Tb7Inm9zWG4fO4D_9dAPhSyPHlBu2E1bsZoDywR72Y4eVgduNxcW28X9sbuhB1MruCNZx9TAzzz5nvGR6S9lkgMTJ6t119y7aBRJxd1hQDE2fmDz6itsW1ZLCjnyh2FftOzBWJgj6zLo4-BhvtOOrXKo0Zz5u3XrQjJk6GfpRfKbWKYv501UMJUGkVBLpMJQ0--ssta8SyFNTAhh-keRxb3ZceSAfbFc-CPUrFik8jU-OEwsOsxftjUdDrr4OfeSc-a98BfPukMgi4wS1r7gBKLkpJQTt0ZQRUWm5u50Sdu60kihZOFMJXhEQiLi2xaVOms4lO-yH64_Z2c9JEVFhyNU9XDWVbCJYJU3Lz8OONbQPh2WOfi0GWhxodPKoQ4dceVZJNx6dh4_H3xUDNEW6V5au_M1w_zuQyNL6XHxIetJak9M9jhsku-659cl-m7INpnY-gzL0mrmkgyNRTLGduUM8OTAa2CTqxZh3PpKI8CshPGbTCPOcV0_BzkfApGmk8QYW57x3qDUYw"
}
```

### HTTP Request
`POST api/paciente/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nombre_completo` | string |  required  | 
        `ciudad` | string |  required  | 
        `email` | email |  required  | 
        `password` | string |  required  | 
        `password_confirmation` | string |  required  | 
        `direccion` | string |  required  | 
        `celular` | string |  optional  | 
        `player_id` | string |  required  | 
        `foto` | string |  optional  | string en base 64
    
<!-- END_119b4ef3e3d4bef52c957390f740463a -->

<!-- START_92bd1a92fa595725def557c5bb7fcc05 -->
## list

muestra la lista de pacintes

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/list"
);

let params = {
    "page": "non",
    "per_page": "facere",
    "filter": "ea",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 3,
            "email": "quika@gmai.com",
            "type": 2,
            "paciente_id": 1,
            "nombre_completo": "Maria lorena chavez arce",
            "ciudad": "cochabamba",
            "direccion": "avenida los angeles numero 23",
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg",
            "matricula": null,
            "admin": null,
            "paciente": {
                "id": 1,
                "nombre_completo": "Maria lorena chavez arce",
                "direccion": "avenida los angeles numero 23",
                "ciudad": "cochabamba",
                "celular": "789898988",
                "src_foto": "user_3200608171905.jpg",
                "player_id": "123123123",
                "user_id": 3,
                "created_at": "2020-06-05T21:08:09.000000Z",
                "updated_at": "2020-06-08T17:19:05.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
            },
            "medico": null
        }
    ],
    "first_page_url": "http:\/\/pacientemedico.ds:998\/api\/paciente\/list?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http:\/\/pacientemedico.ds:998\/api\/paciente\/list?page=1",
    "next_page_url": null,
    "path": "http:\/\/pacientemedico.ds:998\/api\/paciente\/list",
    "per_page": "5",
    "prev_page_url": null,
    "to": 4,
    "total": 4
}
```

### HTTP Request
`GET api/paciente/list`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo, email y celular

<!-- END_92bd1a92fa595725def557c5bb7fcc05 -->

<!-- START_c12f4493cfcce105b3494450b038ee6c -->
## show paciente

muestra los datos de paciente

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/show/1"
);

let params = {
    "id": "et",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 3,
    "email": "quika@gmai.com",
    "type": 2,
    "paciente_id": 1,
    "nombre_completo": "Maria lorena chavez arce",
    "ciudad": "cochabamba",
    "direccion": "avenida los angeles numero 23",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg",
    "matricula": null,
    "admin": null,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "medico": null
}
```

### HTTP Request
`GET api/paciente/show/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | id de usuario

<!-- END_c12f4493cfcce105b3494450b038ee6c -->

<!-- START_a8f3fe879f21dde122c7ff4d3808f839 -->
## update paciente

modifica los datos de paciente

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/update/1"
);

let params = {
    "id": "dicta",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "nombre_completo": "voluptatem",
    "ciudad": "cupiditate",
    "email": "aperiam",
    "direccion": "atque",
    "celular": "adipisci",
    "player_id": "quia",
    "foto": "in"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 3,
    "email": "quika@gmai.com",
    "type": 2,
    "paciente_id": 1,
    "nombre_completo": "Maria lorena chavez arce",
    "ciudad": "cochabamba",
    "direccion": "avenida los angeles numero 23",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg",
    "matricula": null,
    "admin": null,
    "paciente": {
        "id": 1,
        "nombre_completo": "Maria lorena chavez arce",
        "direccion": "avenida los angeles numero 23",
        "ciudad": "cochabamba",
        "celular": "789898988",
        "src_foto": "user_3200608171905.jpg",
        "player_id": "123123123",
        "user_id": 3,
        "created_at": "2020-06-05T21:08:09.000000Z",
        "updated_at": "2020-06-08T17:19:05.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
    },
    "medico": null
}
```

### HTTP Request
`PUT api/paciente/update/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | id de usuario
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nombre_completo` | string |  required  | 
        `ciudad` | string |  required  | 
        `email` | email |  required  | 
        `direccion` | string |  required  | 
        `celular` | string |  optional  | 
        `player_id` | string |  required  | 
        `foto` | string |  optional  | string en base 64
    
<!-- END_a8f3fe879f21dde122c7ff4d3808f839 -->

<!-- START_77faa4dcf971097bfac92dced329877a -->
## mis recetas

muestra las recetas del paciente.
El parametro id es opcional de  lo contrario
el usuario se establece desde el Accesss token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/recetas"
);

let params = {
    "id": "quasi",
    "page": "id",
    "per_page": "et",
    "filter": "doloribus",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "medico_id": 1,
            "medico": {
                "id": 1,
                "nombre_completo": "katara caballero otsank",
                "direccion": "avensaida los angeles de charly",
                "ciudad": "parags222asuay",
                "celular": "4344436",
                "src_foto": "medico_1200610162742.jpg",
                "src_matricula": "medico_matricula_1200607141802.jpg",
                "player_id": "123123123",
                "user_id": 1,
                "created_at": "2020-06-04T21:21:16.000000Z",
                "updated_at": "2020-06-10T16:27:43.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
                "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
            },
            "paciente_id": 1,
            "paciente": {
                "id": 1,
                "nombre_completo": "Maria lorena chavez arce",
                "direccion": "avenida los angeles numero 23",
                "ciudad": "cochabamba",
                "celular": "789898988",
                "src_foto": "user_3200608171905.jpg",
                "player_id": "123123123",
                "user_id": 3,
                "created_at": "2020-06-05T21:08:09.000000Z",
                "updated_at": "2020-06-08T17:19:05.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
            },
            "fecha": "2020-06-05",
            "fecha_inicio": "2019-08-02",
            "fecha_fin": "2019-08-20",
            "observacion": null,
            "vigente": true,
            "medicamentos": [
                {
                    "id": 3,
                    "receta_id": 2,
                    "medicamento_id": 1,
                    "medida": "100 mg",
                    "medicamento": {
                        "id": 1,
                        "nombre": "paracetamol",
                        "descripcion": "es una paracetmoru",
                        "disponible": true,
                        "src_foto": "medicamento_1200607124405.jpg",
                        "precio": 10,
                        "observacion": "descripcion del paracetamoru",
                        "created_at": "2020-06-07T12:44:05.000000Z",
                        "updated_at": "2020-06-07T13:23:17.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                    },
                    "horas": [
                        "06:00",
                        "12:00",
                        "06:00"
                    ]
                }
            ]
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 6
}
```

### HTTP Request
`GET api/paciente/recetas`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | id de usuario.
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_77faa4dcf971097bfac92dced329877a -->

<!-- START_a25e48533898e30ec5549dcc8fa0fd29 -->
## mis recetas

muestra las recetas del paciente.
El parametro id es opcional de  lo contrario
el usuario se establece desde el Accesss token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/recetas/1"
);

let params = {
    "id": "labore",
    "page": "hic",
    "per_page": "dolore",
    "filter": "aut",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "medico_id": 1,
            "medico": {
                "id": 1,
                "nombre_completo": "katara caballero otsank",
                "direccion": "avensaida los angeles de charly",
                "ciudad": "parags222asuay",
                "celular": "4344436",
                "src_foto": "medico_1200610162742.jpg",
                "src_matricula": "medico_matricula_1200607141802.jpg",
                "player_id": "123123123",
                "user_id": 1,
                "created_at": "2020-06-04T21:21:16.000000Z",
                "updated_at": "2020-06-10T16:27:43.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
                "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
            },
            "paciente_id": 1,
            "paciente": {
                "id": 1,
                "nombre_completo": "Maria lorena chavez arce",
                "direccion": "avenida los angeles numero 23",
                "ciudad": "cochabamba",
                "celular": "789898988",
                "src_foto": "user_3200608171905.jpg",
                "player_id": "123123123",
                "user_id": 3,
                "created_at": "2020-06-05T21:08:09.000000Z",
                "updated_at": "2020-06-08T17:19:05.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
            },
            "fecha": "2020-06-05",
            "fecha_inicio": "2019-08-02",
            "fecha_fin": "2019-08-20",
            "observacion": null,
            "vigente": true,
            "medicamentos": [
                {
                    "id": 3,
                    "receta_id": 2,
                    "medicamento_id": 1,
                    "medida": "100 mg",
                    "medicamento": {
                        "id": 1,
                        "nombre": "paracetamol",
                        "descripcion": "es una paracetmoru",
                        "disponible": true,
                        "src_foto": "medicamento_1200607124405.jpg",
                        "precio": 10,
                        "observacion": "descripcion del paracetamoru",
                        "created_at": "2020-06-07T12:44:05.000000Z",
                        "updated_at": "2020-06-07T13:23:17.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                    },
                    "horas": [
                        "06:00",
                        "12:00",
                        "06:00"
                    ]
                }
            ]
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 6
}
```

### HTTP Request
`GET api/paciente/recetas/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | id de usuario.
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_a25e48533898e30ec5549dcc8fa0fd29 -->

<!-- START_572cdacfb63fc32e4b1bd533a4df3dc5 -->
## mis citas

muestra las citas del paciente.
El parametro id es opcional de  lo contrario
el usuario se establece desde el Accesss token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/citas"
);

let params = {
    "page": "officia",
    "per_page": "magnam",
    "filter": "odit",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "medico_id": 1,
            "medico": {
                "id": 1,
                "nombre_completo": "katara caballero otsank",
                "direccion": "avensaida los angeles de charly",
                "ciudad": "parags222asuay",
                "celular": "4344436",
                "src_foto": "medico_1200610162742.jpg",
                "src_matricula": "medico_matricula_1200607141802.jpg",
                "player_id": "123123123",
                "user_id": 1,
                "created_at": "2020-06-04T21:21:16.000000Z",
                "updated_at": "2020-06-10T16:27:43.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
                "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
            },
            "paciente_id": 1,
            "paciente": {
                "id": 1,
                "nombre_completo": "Maria lorena chavez arce",
                "direccion": "avenida los angeles numero 23",
                "ciudad": "cochabamba",
                "celular": "789898988",
                "src_foto": "user_3200608171905.jpg",
                "player_id": "123123123",
                "user_id": 3,
                "created_at": "2020-06-05T21:08:09.000000Z",
                "updated_at": "2020-06-08T17:19:05.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
            },
            "fecha": "2020-05-04",
            "hora": "12:00:00",
            "aprovada": true,
            "pendiente": true,
            "mensaje": null
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 5
}
```

### HTTP Request
`GET api/paciente/citas`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id del usuario.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_572cdacfb63fc32e4b1bd533a4df3dc5 -->

<!-- START_df493ea52e32cfa8a679cb1acc3468cb -->
## mis citas

muestra las citas del paciente.
El parametro id es opcional de  lo contrario
el usuario se establece desde el Accesss token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/citas/maxime"
);

let params = {
    "page": "error",
    "per_page": "eaque",
    "filter": "nulla",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "medico_id": 1,
            "medico": {
                "id": 1,
                "nombre_completo": "katara caballero otsank",
                "direccion": "avensaida los angeles de charly",
                "ciudad": "parags222asuay",
                "celular": "4344436",
                "src_foto": "medico_1200610162742.jpg",
                "src_matricula": "medico_matricula_1200607141802.jpg",
                "player_id": "123123123",
                "user_id": 1,
                "created_at": "2020-06-04T21:21:16.000000Z",
                "updated_at": "2020-06-10T16:27:43.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_1200610162742.jpg",
                "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_1200607141802.jpg"
            },
            "paciente_id": 1,
            "paciente": {
                "id": 1,
                "nombre_completo": "Maria lorena chavez arce",
                "direccion": "avenida los angeles numero 23",
                "ciudad": "cochabamba",
                "celular": "789898988",
                "src_foto": "user_3200608171905.jpg",
                "player_id": "123123123",
                "user_id": 3,
                "created_at": "2020-06-05T21:08:09.000000Z",
                "updated_at": "2020-06-08T17:19:05.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
            },
            "fecha": "2020-05-04",
            "hora": "12:00:00",
            "aprovada": true,
            "pendiente": true,
            "mensaje": null
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 5
}
```

### HTTP Request
`GET api/paciente/citas/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id del usuario.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_df493ea52e32cfa8a679cb1acc3468cb -->

<!-- START_94be4c94a3bf997a2c21fbe73a166600 -->
## mis compras

muestra las compras del paciente.
El parametro id es opcional de  lo contrario
el usuario se establece desde el Accesss token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/compras"
);

let params = {
    "id": "qui",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "paciente_id": 2,
            "paciente": {
                "id": 2,
                "nombre_completo": "adiana condory soto",
                "direccion": "calle principal entra las calles e oreo",
                "ciudad": "cochabamba",
                "celular": "78998777",
                "src_foto": "paciente_12200608094614.jpg",
                "player_id": "123123123",
                "user_id": 12,
                "created_at": "2020-06-08T09:46:14.000000Z",
                "updated_at": "2020-06-08T12:13:46.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
            },
            "fecha": "2020-06-08",
            "hora": "12:37:51",
            "observacion": null,
            "entregado": true,
            "pendiente": false,
            "total": 35,
            "detalle": [
                {
                    "id": 2,
                    "compra_id": 2,
                    "medicamento_id": 1,
                    "cantidad": 2,
                    "created_at": "2020-06-08T12:37:51.000000Z",
                    "updated_at": "2020-06-08T12:37:51.000000Z",
                    "deleted_at": null,
                    "subtotal": 20,
                    "medicamento": {
                        "id": 1,
                        "nombre": "paracetamol",
                        "descripcion": "es una paracetmoru",
                        "disponible": true,
                        "src_foto": "medicamento_1200607124405.jpg",
                        "precio": 10,
                        "observacion": "descripcion del paracetamoru",
                        "created_at": "2020-06-07T12:44:05.000000Z",
                        "updated_at": "2020-06-07T13:23:17.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                    }
                },
                {
                    "id": 3,
                    "compra_id": 2,
                    "medicamento_id": 2,
                    "cantidad": 3,
                    "created_at": "2020-06-08T12:37:51.000000Z",
                    "updated_at": "2020-06-08T12:37:51.000000Z",
                    "deleted_at": null,
                    "subtotal": 15,
                    "medicamento": {
                        "id": 2,
                        "nombre": "arovarbol",
                        "descripcion": "descripcion del medicamento",
                        "disponible": true,
                        "src_foto": "medicamento_2200609172456.jpg",
                        "precio": 5,
                        "observacion": "obsrvacion del medicamento",
                        "created_at": "2020-06-08T09:16:56.000000Z",
                        "updated_at": "2020-06-09T17:24:56.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                    }
                }
            ]
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 8
}
```

### HTTP Request
`GET api/paciente/compras`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | id de usuario

<!-- END_94be4c94a3bf997a2c21fbe73a166600 -->

<!-- START_e19b61012d51f3ace7dca0e5b3549908 -->
## mis compras

muestra las compras del paciente.
El parametro id es opcional de  lo contrario
el usuario se establece desde el Accesss token

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/compras/1"
);

let params = {
    "id": "corrupti",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 2,
            "paciente_id": 2,
            "paciente": {
                "id": 2,
                "nombre_completo": "adiana condory soto",
                "direccion": "calle principal entra las calles e oreo",
                "ciudad": "cochabamba",
                "celular": "78998777",
                "src_foto": "paciente_12200608094614.jpg",
                "player_id": "123123123",
                "user_id": 12,
                "created_at": "2020-06-08T09:46:14.000000Z",
                "updated_at": "2020-06-08T12:13:46.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
            },
            "fecha": "2020-06-08",
            "hora": "12:37:51",
            "observacion": null,
            "entregado": true,
            "pendiente": false,
            "total": 35,
            "detalle": [
                {
                    "id": 2,
                    "compra_id": 2,
                    "medicamento_id": 1,
                    "cantidad": 2,
                    "created_at": "2020-06-08T12:37:51.000000Z",
                    "updated_at": "2020-06-08T12:37:51.000000Z",
                    "deleted_at": null,
                    "subtotal": 20,
                    "medicamento": {
                        "id": 1,
                        "nombre": "paracetamol",
                        "descripcion": "es una paracetmoru",
                        "disponible": true,
                        "src_foto": "medicamento_1200607124405.jpg",
                        "precio": 10,
                        "observacion": "descripcion del paracetamoru",
                        "created_at": "2020-06-07T12:44:05.000000Z",
                        "updated_at": "2020-06-07T13:23:17.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
                    }
                },
                {
                    "id": 3,
                    "compra_id": 2,
                    "medicamento_id": 2,
                    "cantidad": 3,
                    "created_at": "2020-06-08T12:37:51.000000Z",
                    "updated_at": "2020-06-08T12:37:51.000000Z",
                    "deleted_at": null,
                    "subtotal": 15,
                    "medicamento": {
                        "id": 2,
                        "nombre": "arovarbol",
                        "descripcion": "descripcion del medicamento",
                        "disponible": true,
                        "src_foto": "medicamento_2200609172456.jpg",
                        "precio": 5,
                        "observacion": "obsrvacion del medicamento",
                        "created_at": "2020-06-08T09:16:56.000000Z",
                        "updated_at": "2020-06-09T17:24:56.000000Z",
                        "deleted_at": null,
                        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
                    }
                }
            ]
        }
    ],
    "current_page": "1",
    "per_page": "2",
    "total": 8
}
```

### HTTP Request
`GET api/paciente/compras/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | id de usuario

<!-- END_e19b61012d51f3ace7dca0e5b3549908 -->

<!-- START_18e59f2f1a44e10d65d2e2c5622bda76 -->
## list all

muestra la lista de todos los paciente registrados

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/get/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 3,
        "type": 2,
        "email": "laura@gmail.com",
        "email_verified_at": null,
        "created_at": "2020-06-08T17:17:41.000000Z",
        "updated_at": "2020-06-08T17:17:41.000000Z",
        "deleted_at": null,
        "nombre_completo": "maría lorena sánchez",
        "direccion": "Calle 18 de octubre entre pasaje 6 alto cbba",
        "ciudad": "perito",
        "celular": "75977665",
        "src_foto": "paciente_13200608171741.jpg",
        "player_id": "ninguno",
        "user_id": 13,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg",
        "matricula": null,
        "admin": null,
        "paciente": {
            "id": 1,
            "nombre_completo": "Maria lorena chavez arce",
            "direccion": "avenida los angeles numero 23",
            "ciudad": "cochabamba",
            "celular": "789898988",
            "src_foto": "user_3200608171905.jpg",
            "player_id": "123123123",
            "user_id": 3,
            "created_at": "2020-06-05T21:08:09.000000Z",
            "updated_at": "2020-06-08T17:19:05.000000Z",
            "deleted_at": null,
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_3200608171905.jpg"
        },
        "medico": null
    }
]
```

### HTTP Request
`GET api/paciente/get/list`


<!-- END_18e59f2f1a44e10d65d2e2c5622bda76 -->

<!-- START_19a3da3aa961ed10ca7f2b3d35164d4f -->
## mis medicos

muestra la lista de medicos que tiene este paciente

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/medicos"
);

let params = {
    "id": "sed",
    "page": "beatae",
    "per_page": "esse",
    "filter": "culpa",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET api/paciente/medicos`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | id de usuario
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_19a3da3aa961ed10ca7f2b3d35164d4f -->

<!-- START_a8699eb4f21a0deaf06bf692d789c721 -->
## mis medicos

muestra la lista de medicos que tiene este paciente

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/medicos/1"
);

let params = {
    "id": "praesentium",
    "page": "ut",
    "per_page": "odio",
    "filter": "dolores",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET api/paciente/medicos/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | id de usuario
    `page` |  required  | numero de pagina
    `per_page` |  required  | cantidad de items por pagina
    `filter` |  optional  | es un objeto json con nombre_completo

<!-- END_a8699eb4f21a0deaf06bf692d789c721 -->

#Receta


un receta medica puede ser creada por un medico y leida por un paciente, 
ademas de tener una lista dicamentos que a su vez tiene una lista horarios 
que son usados para programar notificaciones en una fecha y hora determinadal en one signal.
<!-- START_a1bcb40fc673756cf935a0b8699e57a6 -->
## create

Registra una nueva receta.

Medicamentto: {
	    "medicamento_id":"1",
         "medida":"1 mg",
         "horas":[
             "06:00",
             "12:00",
             "20:00"
         ]
    }

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/receta/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "fecha_inicio": "2020-06-17",
    "fecha_fin": "2020-06-19",
    "paciente_id": 2,
    "medicamentos": "Array de medicamentos"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 7,
    "medico_id": 2,
    "medico": {
        "id": 2,
        "nombre_completo": "maria toledo mendoza",
        "direccion": "avenida del vino dulce en tre el restaurante de la cazilda",
        "ciudad": "tarija",
        "celular": "765445454",
        "src_foto": "medico_4200607142915.jpg",
        "src_matricula": "medico_matricula_4200607142915.jpg",
        "player_id": "123123123",
        "user_id": 4,
        "created_at": "2020-06-07T14:29:16.000000Z",
        "updated_at": "2020-06-16T15:25:40.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_4200607142915.jpg",
        "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_4200607142915.jpg"
    },
    "paciente_id": "2",
    "paciente": {
        "id": 2,
        "nombre_completo": "adiana condory soto",
        "direccion": "calle principal entra las calles e oreo",
        "ciudad": "cochabamba",
        "celular": "78998777",
        "src_foto": "paciente_12200608094614.jpg",
        "player_id": "123123123",
        "user_id": 12,
        "created_at": "2020-06-08T09:46:14.000000Z",
        "updated_at": "2020-06-08T12:13:46.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
    },
    "fecha": "2020-06-16",
    "fecha_inicio": "2020-06-17",
    "fecha_fin": "2020-06-19",
    "observacion": null,
    "vigente": true,
    "medicamentos": [
        {
            "id": 18,
            "receta_id": 7,
            "medicamento_id": 1,
            "medida": "1 mg",
            "medicamento": {
                "id": 1,
                "nombre": "paracetamol",
                "descripcion": "es una paracetmoru",
                "disponible": true,
                "src_foto": "medicamento_1200607124405.jpg",
                "precio": 10,
                "observacion": "descripcion del paracetamoru",
                "created_at": "2020-06-07T12:44:05.000000Z",
                "updated_at": "2020-06-07T13:23:17.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
            },
            "horas": [
                "06:00:00",
                "12:00:00",
                "20:00:00"
            ]
        },
        {
            "id": 19,
            "receta_id": 7,
            "medicamento_id": 2,
            "medida": "1 ml",
            "medicamento": {
                "id": 2,
                "nombre": "arovarbol",
                "descripcion": "descripcion del medicamento",
                "disponible": true,
                "src_foto": "medicamento_2200609172456.jpg",
                "precio": 5,
                "observacion": "obsrvacion del medicamento",
                "created_at": "2020-06-08T09:16:56.000000Z",
                "updated_at": "2020-06-09T17:24:56.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
            },
            "horas": [
                "06:00:00",
                "12:00:00",
                "20:00:00"
            ]
        }
    ]
}
```

### HTTP Request
`POST api/receta/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `fecha_inicio` | date |  required  | Inicio del tratamiento.
        `fecha_fin` | date |  required  | Fin del tratamiento.
        `paciente_id` | integer |  required  | Id del paciente.
        `medicamentos` | Array |  required  | Lista de medicamentos cada uno con una lista de horarios.
    
<!-- END_a1bcb40fc673756cf935a0b8699e57a6 -->

<!-- START_5ef29c5b73f48cf90546e0436a4b9b49 -->
## show

muestra los datos de una receta

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/receta/show/et"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 7,
    "medico_id": 2,
    "medico": {
        "id": 2,
        "nombre_completo": "maria toledo mendoza",
        "direccion": "avenida del vino dulce en tre el restaurante de la cazilda",
        "ciudad": "tarija",
        "celular": "765445454",
        "src_foto": "medico_4200607142915.jpg",
        "src_matricula": "medico_matricula_4200607142915.jpg",
        "player_id": "123123123",
        "user_id": 4,
        "created_at": "2020-06-07T14:29:16.000000Z",
        "updated_at": "2020-06-16T15:25:40.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_4200607142915.jpg",
        "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_4200607142915.jpg"
    },
    "paciente_id": "2",
    "paciente": {
        "id": 2,
        "nombre_completo": "adiana condory soto",
        "direccion": "calle principal entra las calles e oreo",
        "ciudad": "cochabamba",
        "celular": "78998777",
        "src_foto": "paciente_12200608094614.jpg",
        "player_id": "123123123",
        "user_id": 12,
        "created_at": "2020-06-08T09:46:14.000000Z",
        "updated_at": "2020-06-08T12:13:46.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
    },
    "fecha": "2020-06-16",
    "fecha_inicio": "2020-06-17",
    "fecha_fin": "2020-06-19",
    "observacion": null,
    "vigente": true,
    "medicamentos": [
        {
            "id": 18,
            "receta_id": 7,
            "medicamento_id": 1,
            "medida": "1 mg",
            "medicamento": {
                "id": 1,
                "nombre": "paracetamol",
                "descripcion": "es una paracetmoru",
                "disponible": true,
                "src_foto": "medicamento_1200607124405.jpg",
                "precio": 10,
                "observacion": "descripcion del paracetamoru",
                "created_at": "2020-06-07T12:44:05.000000Z",
                "updated_at": "2020-06-07T13:23:17.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
            },
            "horas": [
                "06:00:00",
                "12:00:00",
                "20:00:00"
            ]
        },
        {
            "id": 19,
            "receta_id": 7,
            "medicamento_id": 2,
            "medida": "1 ml",
            "medicamento": {
                "id": 2,
                "nombre": "arovarbol",
                "descripcion": "descripcion del medicamento",
                "disponible": true,
                "src_foto": "medicamento_2200609172456.jpg",
                "precio": 5,
                "observacion": "obsrvacion del medicamento",
                "created_at": "2020-06-08T09:16:56.000000Z",
                "updated_at": "2020-06-09T17:24:56.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
            },
            "horas": [
                "06:00:00",
                "12:00:00",
                "20:00:00"
            ]
        }
    ]
}
```

### HTTP Request
`GET api/receta/show/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de receta

<!-- END_5ef29c5b73f48cf90546e0436a4b9b49 -->

<!-- START_2b9149a42abd49dca0d59dc18efd3b82 -->
## update

modifica una receta.
medicamento = {
    "id":"12",
    "medicamento_id":"2",
    "medida":"2 mg",
    "horas":[
        {
            "id":"",
            "hora":"",
        },
        {
            "id":"",
            "hora":"",
        },
    ],
}

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/receta/update/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "fecha_inicio": "non",
    "fecha_fin": "magni",
    "paciente_id": 7,
    "medicamentos": "dignissimos",
    "vigente": "iure"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 7,
    "medico_id": 2,
    "medico": {
        "id": 2,
        "nombre_completo": "maria toledo mendoza",
        "direccion": "avenida del vino dulce en tre el restaurante de la cazilda",
        "ciudad": "tarija",
        "celular": "765445454",
        "src_foto": "medico_4200607142915.jpg",
        "src_matricula": "medico_matricula_4200607142915.jpg",
        "player_id": "123123123",
        "user_id": 4,
        "created_at": "2020-06-07T14:29:16.000000Z",
        "updated_at": "2020-06-16T15:25:40.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medico_4200607142915.jpg",
        "matricula": "http:\/\/pacientemedico.ds:998\/uploads\/medico_matricula_4200607142915.jpg"
    },
    "paciente_id": "2",
    "paciente": {
        "id": 2,
        "nombre_completo": "adiana condory soto",
        "direccion": "calle principal entra las calles e oreo",
        "ciudad": "cochabamba",
        "celular": "78998777",
        "src_foto": "paciente_12200608094614.jpg",
        "player_id": "123123123",
        "user_id": 12,
        "created_at": "2020-06-08T09:46:14.000000Z",
        "updated_at": "2020-06-08T12:13:46.000000Z",
        "deleted_at": null,
        "foto": "http:\/\/pacientemedico.ds:998\/uploads\/paciente_12200608094614.jpg"
    },
    "fecha": "2020-06-16",
    "fecha_inicio": "2020-06-17",
    "fecha_fin": "2020-06-19",
    "observacion": null,
    "vigente": true,
    "medicamentos": [
        {
            "id": 18,
            "receta_id": 7,
            "medicamento_id": 1,
            "medida": "1 mg",
            "medicamento": {
                "id": 1,
                "nombre": "paracetamol",
                "descripcion": "es una paracetmoru",
                "disponible": true,
                "src_foto": "medicamento_1200607124405.jpg",
                "precio": 10,
                "observacion": "descripcion del paracetamoru",
                "created_at": "2020-06-07T12:44:05.000000Z",
                "updated_at": "2020-06-07T13:23:17.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_1200607124405.jpg"
            },
            "horas": [
                "06:00:00",
                "12:00:00",
                "20:00:00"
            ]
        },
        {
            "id": 19,
            "receta_id": 7,
            "medicamento_id": 2,
            "medida": "1 ml",
            "medicamento": {
                "id": 2,
                "nombre": "arovarbol",
                "descripcion": "descripcion del medicamento",
                "disponible": true,
                "src_foto": "medicamento_2200609172456.jpg",
                "precio": 5,
                "observacion": "obsrvacion del medicamento",
                "created_at": "2020-06-08T09:16:56.000000Z",
                "updated_at": "2020-06-09T17:24:56.000000Z",
                "deleted_at": null,
                "foto": "http:\/\/pacientemedico.ds:998\/uploads\/medicamento_2200609172456.jpg"
            },
            "horas": [
                "06:00:00",
                "12:00:00",
                "20:00:00"
            ]
        }
    ]
}
```

### HTTP Request
`PUT api/receta/update/{id}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `fecha_inicio` | string |  required  | 
        `fecha_fin` | string |  required  | 
        `paciente_id` | integer |  required  | 
        `medicamentos` | Array |  required  | Array de medicamentos
        `vigente` | string |  required  | 
    
<!-- END_2b9149a42abd49dca0d59dc18efd3b82 -->

<!-- START_05679e53b26c7a837d91c4fbdc7fe333 -->
## delete

Eliminar receta.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/receta/delete/nostrum"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Eliminado correctamente"
```

### HTTP Request
`DELETE api/receta/delete/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de receta.

<!-- END_05679e53b26c7a837d91c4fbdc7fe333 -->

<!-- START_a694b9bb4b1dbf81a69526a9347a0e53 -->
## restore

Restaura receta.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/receta/restore/aliquid"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Restaurado correctamente"
```

### HTTP Request
`DELETE api/receta/restore/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de receta.

<!-- END_a694b9bb4b1dbf81a69526a9347a0e53 -->

<!-- START_4658c83346a532c54e9caf23f2e7c667 -->
## parar notificaciones

Eliminar las notificaiones que se crearon de la receta.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/receta/parar-notificaciones/nihil"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Notificaciones eliminadas",
    "id": 1
}
```

### HTTP Request
`PATCH api/receta/parar-notificaciones/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de receta.

<!-- END_4658c83346a532c54e9caf23f2e7c667 -->

<!-- START_f0ed9ef3790c29701cfbb051bf11a6ec -->
## activar notificaciones

Activar las notificaiones que se crearon de la receta.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/receta/activar-notificaciones/tenetur"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Notificaciones eliminadas",
    "id": 1
}
```

### HTTP Request
`PATCH api/receta/activar-notificaciones/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de receta.

<!-- END_f0ed9ef3790c29701cfbb051bf11a6ec -->

#User


Un usuario puede ser de tipo Admin, Paciente y Medico
<!-- START_bb3fea7609e6705509cd43016134ab8b -->
## Olvide password (public)

Olvide password de usuario de tipo admin,
envia un email con un link para recuperar la contrasena.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/forgot-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "autem"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Revise su bandeja de entrada de su correo electronico"
}
```

### HTTP Request
`POST api/admin/forgot-password`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | 
    
<!-- END_bb3fea7609e6705509cd43016134ab8b -->

<!-- START_9ff4fae97d5af840b9e76042c00a5e02 -->
## Admin list

Obtiene la lista de usuarios de tipo admin.
filter = {
     "nombre_completo":"",
     "email":""
}

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 2,
            "email": "admin@admin.com",
            "nombre_completo": "admin",
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg",
            "matricula": null,
            "admin": {
                "id": 1,
                "nombre_completo": "admin",
                "foto": "user_2200608000357.jpg",
                "created_at": "2020-06-05T18:46:17.000000Z",
                "updated_at": "2020-06-08T00:03:57.000000Z",
                "deleted_at": null
            },
            "medico": null
        },
        {
            "id": 5,
            "email": "gato@gmail.com",
            "nombre_completo": "gato con botas",
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_5200608223855.jpg",
            "matricula": null,
            "admin": {
                "id": 2,
                "nombre_completo": "gato con botas",
                "foto": "user_5200608223855.jpg",
                "created_at": "2020-06-08T00:05:34.000000Z",
                "updated_at": "2020-06-08T22:38:55.000000Z",
                "deleted_at": null
            },
            "medico": null
        },
        {
            "id": 6,
            "email": "melania@gmail.com",
            "nombre_completo": "melani tromp de lavaldes",
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_6200608001120.jpg",
            "matricula": null,
            "admin": {
                "id": 3,
                "nombre_completo": "melani tromp de lavaldes",
                "foto": "user_6200608001120.jpg",
                "created_at": "2020-06-08T00:11:20.000000Z",
                "updated_at": "2020-06-08T00:11:20.000000Z",
                "deleted_at": null
            },
            "medico": null
        },
        {
            "id": 7,
            "email": "drama@gmail.com",
            "nombre_completo": "drama",
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_7200608002049.jpg",
            "matricula": null,
            "admin": {
                "id": 4,
                "nombre_completo": "drama",
                "foto": "user_7200608002049.jpg",
                "created_at": "2020-06-08T00:13:36.000000Z",
                "updated_at": "2020-06-08T00:20:49.000000Z",
                "deleted_at": null
            },
            "medico": null
        },
        {
            "id": 8,
            "email": "sandra@gmail.com",
            "nombre_completo": "sandra mamani garcia",
            "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_8200608002035.jpg",
            "matricula": null,
            "admin": {
                "id": 5,
                "nombre_completo": "sandra mamani garcia",
                "foto": "user_8200608002035.jpg",
                "created_at": "2020-06-08T00:15:20.000000Z",
                "updated_at": "2020-06-08T00:20:35.000000Z",
                "deleted_at": null
            },
            "medico": null
        }
    ],
    "first_page_url": "http:\/\/pacientemedico.ds:998\/api\/admin\/list?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http:\/\/pacientemedico.ds:998\/api\/admin\/list?page=2",
    "next_page_url": "http:\/\/pacientemedico.ds:998\/api\/admin\/list?page=2",
    "path": "http:\/\/pacientemedico.ds:998\/api\/admin\/list",
    "per_page": "5",
    "prev_page_url": null,
    "to": 5,
    "total": 9
}
```

### HTTP Request
`GET api/admin/list`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `filter` |  optional  | Object

<!-- END_9ff4fae97d5af840b9e76042c00a5e02 -->

<!-- START_76b24be2bc1097bd2d9827d65bfcdab5 -->
## Mostrar uusario

Mostrar usuario de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/show/adipisci"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 2,
    "nombre_completo": "admin",
    "email": "admin@admin.com",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg"
}
```

### HTTP Request
`GET api/admin/show/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.

<!-- END_76b24be2bc1097bd2d9827d65bfcdab5 -->

<!-- START_cc6f981211045d1ff2293974fc326721 -->
## Modificar uusario

Modificar usuario de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/update/repellat"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "{": "et"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 2,
    "nombre_completo": "admin",
    "email": "admin@admin.com",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg"
}
```

### HTTP Request
`PUT api/admin/update/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `{` | &quot;nombre_completo&quot;: |  optional  | "admin",
    
<!-- END_cc6f981211045d1ff2293974fc326721 -->

<!-- START_ba8fd72f77279075c962c776adfe1cf4 -->
## Modificar email

Modificar el mail del usuario de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/update-email/enim"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "{": "doloremque"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 2,
    "nombre_completo": "admin",
    "email": "admin@admin.com",
    "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg"
}
```

### HTTP Request
`PATCH api/admin/update-email/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `{` | &quot;email&quot;: |  optional  | "admin@admin.com",
    
<!-- END_ba8fd72f77279075c962c776adfe1cf4 -->

<!-- START_c0ff239239894c5b5e85e51cd4d3ec81 -->
## Modificar email

Modificar el mail del usuario de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/update-password/non"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "{": "natus"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`PATCH api/admin/update-password/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `{` | &quot;password&quot;: |  optional  | "123123123",
    
<!-- END_c0ff239239894c5b5e85e51cd4d3ec81 -->

<!-- START_22fb7bfaa740958c7a06c96e9c88155d -->
## Delete usuario

Eliminar usuario de tipo admin, paciente o medico

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/delete/accusamus"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Se elimino correctamente"
```

### HTTP Request
`DELETE api/admin/delete/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.

<!-- END_22fb7bfaa740958c7a06c96e9c88155d -->

<!-- START_d78ecf6c2dd5d9d0b7defd5ba1263566 -->
## Restaurar usuario

Restaurar usuario de tipo admin, paciente o medico

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/admin/restore/illo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Se elimino correctamente"
```

### HTTP Request
`DELETE api/admin/restore/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.

<!-- END_d78ecf6c2dd5d9d0b7defd5ba1263566 -->

<!-- START_d80e8edd538f136cbfae4779abd61e96 -->
## Olvide password Code (public)

Olvide password de usuario de paciente o medico,
envia un codigo al email para confirmar y cambiar el password posteriormente.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/send-code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "expedita"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Codigo enviado su email"
}
```

### HTTP Request
`POST api/send-code`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | 
    
<!-- END_d80e8edd538f136cbfae4779abd61e96 -->

<!-- START_c17cb0fbafe6c59dad2ba426b81abd62 -->
## Validate Code (public)

Valida el codigo recibido por email.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/validate-code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "enim",
    "codigo": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`POST api/validate-code`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | 
        `codigo` | integer |  required  | 
    
<!-- END_c17cb0fbafe6c59dad2ba426b81abd62 -->

<!-- START_709733d1f5a974c909edec9f6b811efa -->
## cambiar password

Cambiar password con el codigo validado par usuarios de tipo paciente o medico.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/change-password/quia"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "password_nuevo": "vero",
    "password_nuevo_confirmation": "est"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Password modificado correctamente"
```

### HTTP Request
`POST api/change-password/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id del usuario
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `password_nuevo` | string |  required  | 
        `password_nuevo_confirmation` | string |  required  | 
    
<!-- END_709733d1f5a974c909edec9f6b811efa -->

<!-- START_925e400194d8295aa6bbc48d5a274e00 -->
## Modificar email

Modificar el mail del usuario de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/update-password/est"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "{": "et"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`PATCH api/paciente/update-password/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `{` | &quot;password&quot;: |  optional  | "123123123",
    
<!-- END_925e400194d8295aa6bbc48d5a274e00 -->

<!-- START_2b2a4a29da1597d06fe919ab5beeb588 -->
## Delete usuario

Eliminar usuario de tipo admin, paciente o medico

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/delete/ut"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Se elimino correctamente"
```

### HTTP Request
`DELETE api/paciente/delete/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.

<!-- END_2b2a4a29da1597d06fe919ab5beeb588 -->

<!-- START_7a8db317e72fca113209691bc61b8885 -->
## Restaurar usuario

Restaurar usuario de tipo admin, paciente o medico

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/paciente/restore/libero"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Se elimino correctamente"
```

### HTTP Request
`DELETE api/paciente/restore/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.

<!-- END_7a8db317e72fca113209691bc61b8885 -->

<!-- START_8c92dcd313a2c74a40c003f9f88caff3 -->
## Modificar email

Modificar el mail del usuario de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/update-password/laboriosam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "{": "in"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`PATCH api/medico/update-password/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `{` | &quot;password&quot;: |  optional  | "123123123",
    
<!-- END_8c92dcd313a2c74a40c003f9f88caff3 -->

<!-- START_4ae22ca55c3d9f5df3a07186ae880fc5 -->
## Delete usuario

Eliminar usuario de tipo admin, paciente o medico

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/delete/quia"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Se elimino correctamente"
```

### HTTP Request
`DELETE api/medico/delete/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.

<!-- END_4ae22ca55c3d9f5df3a07186ae880fc5 -->

<!-- START_762a7e5990e3301912c32db40ac04c7e -->
## Restaurar usuario

Restaurar usuario de tipo admin, paciente o medico

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/medico/restore/accusamus"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
"Se elimino correctamente"
```

### HTTP Request
`DELETE api/medico/restore/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id de usuario.

<!-- END_762a7e5990e3301912c32db40ac04c7e -->

<!-- START_0b7077d16b0b6ffabe5eaf66a78be536 -->
## panel user

muestra la lista de uuarios de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/usuarios"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET usuarios`


<!-- END_0b7077d16b0b6ffabe5eaf66a78be536 -->

<!-- START_6cc4b66a1dc535196449a046461fda6a -->
## panel user

muestra el perfil de uuarios de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/profile/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET profile/{id?}`


<!-- END_6cc4b66a1dc535196449a046461fda6a -->

<!-- START_02c1e2f1951c33cb7d8664cf4ebda4b3 -->
## panel user

modifica el perfil de uuarios de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/update-perfil/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST update-perfil/{id?}`


<!-- END_02c1e2f1951c33cb7d8664cf4ebda4b3 -->

<!-- START_99e01cef93a9aa809e823e850ae27bf7 -->
## panel user

muestra la pagin para editar el perfil de un usuario de tipo admin

> Example request:

```javascript
const url = new URL(
    "http://localhost/modificar-perfil/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET modificar-perfil/{id?}`


<!-- END_99e01cef93a9aa809e823e850ae27bf7 -->

#general


<!-- START_0c068b4037fb2e47e71bd44bd36e3e2a -->
## Authorize a client to access the user&#039;s account.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/authorize`


<!-- END_0c068b4037fb2e47e71bd44bd36e3e2a -->

<!-- START_e48cc6a0b45dd21b7076ab2c03908687 -->
## Approve the authorization request.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/authorize`


<!-- END_e48cc6a0b45dd21b7076ab2c03908687 -->

<!-- START_de5d7581ef1275fce2a229b6b6eaad9c -->
## Deny the authorization request.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/authorize`


<!-- END_de5d7581ef1275fce2a229b6b6eaad9c -->

<!-- START_a09d20357336aa979ecd8e3972ac9168 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token`


<!-- END_a09d20357336aa979ecd8e3972ac9168 -->

<!-- START_d6a56149547e03307199e39e03e12d1c -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/tokens`


<!-- END_d6a56149547e03307199e39e03e12d1c -->

<!-- START_a9a802c25737cca5324125e5f60b72a5 -->
## Delete the given token.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/tokens/{token_id}`


<!-- END_a9a802c25737cca5324125e5f60b72a5 -->

<!-- START_abe905e69f5d002aa7d26f433676d623 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/token/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token/refresh`


<!-- END_abe905e69f5d002aa7d26f433676d623 -->

<!-- START_babcfe12d87b8708f5985e9d39ba8f2c -->
## Get all of the clients for the authenticated user.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/clients`


<!-- END_babcfe12d87b8708f5985e9d39ba8f2c -->

<!-- START_9eabf8d6e4ab449c24c503fcb42fba82 -->
## Store a new client.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/clients`


<!-- END_9eabf8d6e4ab449c24c503fcb42fba82 -->

<!-- START_784aec390a455073fc7464335c1defa1 -->
## Update the given client.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT oauth/clients/{client_id}`


<!-- END_784aec390a455073fc7464335c1defa1 -->

<!-- START_1f65a511dd86ba0541d7ba13ca57e364 -->
## Delete the given client.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/clients/{client_id}`


<!-- END_1f65a511dd86ba0541d7ba13ca57e364 -->

<!-- START_9e281bd3a1eb1d9eb63190c8effb607c -->
## Get all of the available scopes for the application.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/scopes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/scopes`


<!-- END_9e281bd3a1eb1d9eb63190c8effb607c -->

<!-- START_9b2a7699ce6214a79e0fd8107f8b1c9e -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/personal-access-tokens`


<!-- END_9b2a7699ce6214a79e0fd8107f8b1c9e -->

<!-- START_a8dd9c0a5583742e671711f9bb3ee406 -->
## Create a new personal access token for the user.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/personal-access-tokens`


<!-- END_a8dd9c0a5583742e671711f9bb3ee406 -->

<!-- START_bae65df80fd9d72a01439241a9ea20d0 -->
## Delete the given token.

> Example request:

```javascript
const url = new URL(
    "http://localhost/oauth/personal-access-tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/personal-access-tokens/{token_id}`


<!-- END_bae65df80fd9d72a01439241a9ea20d0 -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Show the application&#039;s login form.

> Example request:

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Handle a login request to the application.

> Example request:

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## Log the user out of the application.

> Example request:

```javascript
const url = new URL(
    "http://localhost/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```javascript
const url = new URL(
    "http://localhost/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```javascript
const url = new URL(
    "http://localhost/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_b77aedc454e9471a35dcb175278ec997 -->
## Display the password confirmation view.

> Example request:

```javascript
const url = new URL(
    "http://localhost/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET password/confirm`


<!-- END_b77aedc454e9471a35dcb175278ec997 -->

<!-- START_54462d3613f2262e741142161c0e6fea -->
## Confirm the given user&#039;s password.

> Example request:

```javascript
const url = new URL(
    "http://localhost/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/confirm`


<!-- END_54462d3613f2262e741142161c0e6fea -->

<!-- START_cb859c8e84c35d7133b6a6c8eac253f8 -->
## Show the application dashboard.

> Example request:

```javascript
const url = new URL(
    "http://localhost/home"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET home`


<!-- END_cb859c8e84c35d7133b6a6c8eac253f8 -->


