# Documentacion del Proyecto Formato Unico Personal

## Resumen general

El proyecto `Formato_Unico_Personal` es una aplicacion PHP tradicional para gestionar el FUP, Formato Unico de Personal. La aplicacion permite consultar informacion de trabajadores, crear FUPs, generar PDFs, autorizar, rechazar, reimprimir y consultar documentos.

No usa un framework MVC moderno. La arquitectura esta organizada por carpetas funcionales: conexion, pantallas, JavaScript, generacion de PDF, archivos generados, librerias y recursos visuales.

## Arquitectura general

La aplicacion funciona como un monolito PHP:

- Frontend: HTML generado por PHP, jQuery, Bootstrap y JavaScript propio.
- Backend: PHP procedural, con algunos helpers y una clase simple para permisos.
- Servicios: consumo de Web Services SOAP.
- Datos: principalmente mediante el Web Service `getConsulta`; la conexion directa a SQL Server se usa sobre todo para permisos.
- Documentos: generacion de PDF con FPDF/FPDI.
- Almacenamiento local: PDFs, codigos de barras, logos, sellos y archivos exportados.

El punto de entrada principal es:

```text
index.php
```

Desde ahi se cargan la validacion de sesion, la conexion, permisos, pantallas y scripts del frontend.

## Estructura de carpetas

### `Conexion/`

Contiene la configuracion de conexion, clientes SOAP, permisos y endpoints auxiliares.

Archivos importantes:

- `conexion.php`: abre conexion directa a SQL Server con `sqlsrv_connect`.
- `wsdl.php`: crea el cliente SOAP principal `$cliente`.
- `wsdl_foliacion.php`: crea el cliente SOAP de foliacion `$cliente2`.
- `ServicioWeb.php`: wrapper que carga `wsdl.php` y muestra error amigable si falla SOAP.
- `permisos.php`: define la clase `Permisos`.
- `Datos/`: endpoints para autocompletados y catalogos.
- `DatosR/`: endpoints similares para otra variante del flujo.
- `ObtenerNum_Docto/`, `ObtenerNum_DoctoR/`, `ObtenerNum_DoctorO/`: consultas relacionadas con numero de documento.
- `ObtenerNomEmp/`, `ObtenerNomEmpR/`: consultas de nombre de empleado.

### `pantallas/`

Contiene pantallas y endpoints del flujo principal:

- FUP original.
- FUP cambio CT.
- pendientes por perfil.
- autorizados.
- reportes.
- consultas locales de PDF.
- acciones de autorizar o rechazar.

Ejemplos:

- `FUP_CambioCT.php`
- `Pendientes_Paty.php`
- `Pendientes_Directora.php`
- `Fups_Autorizados.php`
- `data_fups_autorizados.php`
- `update_autorizar_4.php`
- `update_rechazar_admin.php`
- `update_rechazar_cgrh.php`

### `pantallas_cambio/`

Modulo paralelo para cambios, bajas, licencias y guiones. Tiene endpoints de datos, pendientes, autorizaciones y rechazos.

Ejemplos:

- `insertar.php`
- `Pendientes_Paty.php`
- `Pendientes_Directora.php`
- `Fups_Autorizados.php`
- `data_Bajas_*.php`
- `data_Licencias_*.php`
- `data_Guiones_*.php`
- `update_autorizar_*.php`
- `update_rechazar_*.php`

### `Js/` y `Js_cambio/`

Contienen la logica del frontend:

- validaciones.
- autocompletados.
- envio de formularios.
- manejo de modales.
- llamadas AJAX.
- apertura de PDFs.
- armado de arreglos seleccionados en tablas.

Ejemplos:

- `enviar6.js`
- `enviar_ma6.js`
- `funciones_index2.js`
- `Scrips49.js`
- `Scripsma50.js`
- `Modals_index.js`
- `validacion.js`

### `Pdf/`

Contiene consultas previas, antecedentes, generacion y reimpresion de documentos.

Subcarpetas importantes:

- `crearPDF/`: scripts principales para crear PDFs.
- `crearPDF/F_Insert/`: inserciones de partes del FUP.
- `crearPDF/Mostrar/`: vistas o apoyos de informacion mostrada en PDF.
- `Reimprimir/`: scripts de reimpresion.

Archivos importantes:

- `Antecedentes.php`
- `AntecedentesPrevio.php`
- `MovimientosPrevio.php`
- `tabla.php`
- `tab.php`
- `process.php`

### `fpdf181/` y `fpdi/`

Librerias externas para trabajar con PDF:

- FPDF: crear PDFs desde PHP.
- FPDI: importar o reutilizar PDFs existentes.

### `Codigo_Barras/`

Contiene imagenes PNG de codigos de barras y el script:

```text
barcode.php
```

### `FUPs/`

Carpeta de salida donde se guardan o agrupan PDFs generados.

### `Logo/`

Imagenes institucionales:

- logos oficiales.
- sellos.
- firmas.
- encabezados.
- favicon.

### `PHPMailer/`

Libreria para envio de correos. Esta presente en el proyecto, aunque no parece ser el eje principal del flujo revisado.

## Autenticacion

La autenticacion se basa en una `key` recibida por `GET` o `POST`.

Archivos relacionados:

- `ValidarKey.php`
- `ValidarKey1.php`
- `ValidarKey3.php`

`ValidarKey.php` valida la llave contra un Web Service externo:

```text
http://cgia.seslp.gob.mx/nlws/Service.asmx?WSDL
```

El metodo usado es:

```text
ValidoKey
```

Se envian parametros como:

- `key`
- usuario
- aplicacion
- llave interna
- IP del cliente
- modulo

Si la sesion no es valida, redirige al login:

```text
http://cgia.seslp.gob.mx/nlogin/Default.aspx?app=1164
```

`ValidarKey3.php` no valida contra el servicio, sino que asigna valores fijos:

```php
$usuario = "Jonathan";
$app = "1164";
$keys = "key";
```

Esto parece ser un archivo de pruebas o bypass local.

## Permisos

Despues de validar la sesion, `index.php` carga:

```php
require_once('Conexion/conexion.php');
include('Conexion/permisos.php');
```

`conexion.php` abre una conexion a SQL Server mediante:

```php
sqlsrv_connect(...)
```

`permisos.php` define la clase:

```php
class Permisos
```

El metodo principal es:

```php
Menu($app, $usuario, $con)
```

Este metodo consulta las opciones permitidas para el usuario en:

```text
[SVRDWH\SBDCGIAPASO].seguridad.dbo.mvc_permisos_opciones
```

Regresa un arreglo con las opciones (`opc`) disponibles para construir o habilitar el menu.

## Conexion al Web Service principal

El cliente SOAP principal esta en:

```text
Conexion/wsdl.php
```

Actualmente apunta al ambiente de pruebas:

```text
https://appcgia.seslp.gob.mx/WebService_FUP_Pruebas/WebService.asmx?WSDL
```

Tambien existe una URL productiva comentada:

```text
https://appcgia.seslp.gob.mx/WebService_FUP/WebService.asmx?WSDL
```

El cliente se crea asi:

```php
$cliente = new SoapClient($url, array('exceptions' => true));
```

Ese cliente se usa en gran parte del sistema con:

```php
$cliente->getConsulta($params);
```

## Conexion al Web Service de foliacion

La foliacion usa:

```text
Conexion/wsdl_foliacion.php
```

Actualmente apunta a pruebas:

```text
https://appcgia.seslp.gob.mx/WebService_FUP_Foliacion_Pruebas/WebService.asmx?WSDL
```

El cliente se guarda en:

```php
$cliente2
```

El metodo observado es:

```php
$cliente2->getFolio($params_Foliacion);
```

Se usa sobre todo en generacion de PDFs de cambio CT.

## Patron general de consumo SOAP

El sistema usa un patron repetido para llamar al Web Service.

Primero se arma un JSON como string:

```php
$JSON = "[{\"campo\":\"valor\"}]";
```

Luego se convierte:

```php
$array = json_decode(json_encode($JSON), true);
```

Despues se construyen parametros:

```php
$params = array(
    'Resultado' => 150,
    'Argumento' => $array,
    'Accion' => 'insert'
);
```

Finalmente se llama:

```php
$resultados = $cliente->getConsulta($params);
```

Los campos principales son:

- `Resultado`: ID numerico de consulta o proceso configurado en el Web Service.
- `Argumento`: datos enviados como JSON.
- `Accion`: tipo de operacion, por ejemplo `select`, `insert` o `update`.

En algunos archivos `Accion` se omite.

## Procesamiento de respuesta SOAP

La respuesta normalmente llega dentro de:

```php
$array['getConsultaResult']['any']
```

Luego se procesa como XML:

```php
$xml = simplexml_load_string($array['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json, true);
```

El resultado suele quedar dentro de:

```text
NewDataSet -> table
```

Muchos endpoints contemplan dos casos:

- cuando viene un solo registro.
- cuando vienen multiples registros.

Por eso se repite mucho esta validacion:

```php
if (!isset($ver[0])) {
    // un solo registro
} else {
    // multiples registros
}
```

## Flujo principal de la aplicacion

El flujo general es:

```text
Usuario
  -> index.php
  -> validacion de key
  -> conexion SQL Server
  -> consulta de permisos
  -> carga de interfaz
  -> eventos JavaScript
  -> AJAX a endpoints PHP
  -> Conexion/ServicioWeb.php
  -> Conexion/wsdl.php
  -> SOAP getConsulta()
  -> respuesta XML
  -> conversion a array/json/html
  -> tabla, formulario o PDF
```

Para foliacion:

```text
Generacion de PDF Cambio CT
  -> Conexion/wsdl_foliacion.php
  -> SOAP getFolio()
  -> folio usado en el PDF
```

## Autocompletados y consultas auxiliares

Los autocompletados estan en carpetas como:

```text
Conexion/Datos/
Conexion/DatosR/
Conexion/ObtenerNum_Docto/
Conexion/ObtenerNum_DoctoR/
Conexion/ObtenerNomEmp/
```

Ejemplo:

```text
Conexion/Datos/RFC.php
```

Este archivo recibe:

```php
$_POST['query']
```

Convierte el texto a mayusculas, valida longitud minima y llama al Web Service con un ID de consulta. Despues devuelve JSON con RFCs encontrados.

Otros endpoints consultan:

- CURP.
- RFC.
- unidad.
- subunidad.
- codigo de pago.
- plaza.
- horas.
- puesto.
- numero de oficio.
- numero de documento.
- nombre de empleado.

## Listados y tablas

Las tablas de la aplicacion se alimentan con endpoints `data_*.php`.

Ejemplos:

```text
pantallas/data_fups_autorizados.php
pantallas/data_cambio_CT.php
pantallas_cambio/data_Bajas_Admin_docentes.php
pantallas_cambio/data_Licencias_paty_docentes.php
```

El formato de salida comun es:

```json
{
  "data": []
}
```

Esto esta pensado para pintar tablas dinamicas en el frontend.

## Autorizaciones y rechazos

Las acciones de autorizacion y rechazo se manejan en archivos como:

```text
pantallas/update_autorizar_4.php
pantallas/update_rechazar_admin.php
pantallas/update_rechazar_cgrh.php
pantallas_cambio/update_autorizar_1.php
pantallas_cambio/update_autorizar_2.php
pantallas_cambio/update_rechazar_admin.php
pantallas_cambio/update_rechazar_cgrh.php
```

Un patron observado es:

1. Recibir datos por `POST`.
2. En algunos casos decodificar una cadena base64.
3. Extraer documentos seleccionados.
4. Armar JSON con `area`, `num_docto`, `num_oficio`, `usuario`, `operacion` y `datoalt`.
5. Llamar a `getConsulta`.
6. Regresar una respuesta simple como `hecho`.

Ejemplo de operacion:

```text
Autorizo Original
```

## Generacion de PDF

La generacion de PDF se concentra en:

```text
Pdf/
Pdf/crearPDF/
Pdf/crearPDF/F_Insert/
Pdf/Reimprimir/
```

Los scripts consultan informacion al Web Service y la combinan con plantillas, logos, sellos, codigos de barras y datos capturados.

Librerias usadas:

- `fpdf181/`: creacion de PDF.
- `fpdi/`: importacion o reutilizacion de documentos PDF.

Archivos importantes:

```text
Pdf/Antecedentes.php
Pdf/AntecedentesPrevio.php
Pdf/MovimientosPrevio.php
Pdf/tabla.php
Pdf/tab.php
Pdf/crearPDF/CreacionFUPOriginal.php
Pdf/crearPDF/CrearFUP_CambioCT.php
Pdf/Reimprimir/Reimpresion.php
```

## Insercion de informacion FUP

La carpeta:

```text
Pdf/crearPDF/F_Insert/
```

separa inserciones por seccion del FUP.

Archivos representativos:

- `FUPID.php`: cabecera o identificador del FUP.
- `FUPPER.php`: datos personales.
- `FUPPLA.php`: datos de plazas.
- `FUPPRE.php`: percepciones.
- `FUPCMP.php`: conceptos/complementos.
- `Bitacora.php`: registro de operaciones.

Estas inserciones tambien se realizan por Web Service usando `getConsulta`.

## Cambio CT

El cambio de centro de trabajo tiene flujo propio en:

```text
pantallas/FUP_CambioCT.php
pantallas/FUP_CambioCT90.php
pantallas/FUP_CambioCT_Pendientes.php
Pdf/crearPDF/CrearFUP_CambioCT.php
Pdf/crearPDF/CrearFUP_CambioCT_manual.php
Pdf/crearPDF/CrearFUP_CambioCT_Pendientes.php
```

Este modulo usa:

- Web Service principal para consultar e insertar datos.
- Web Service de foliacion para obtener folios.
- PDF para generar documento final.

## Reimpresion

La reimpresion se maneja en:

```text
Pdf/Reimprimir/
pantallas/Reimpresion_Original.php
pantallas_cambio/Reimpresion_Original.php
```

El sistema consulta documentos ya existentes o autorizados y vuelve a construir o mostrar el PDF correspondiente.

## Archivos locales generados

El proyecto guarda muchos archivos generados en carpetas locales:

- `FUPs/`: PDFs generados.
- `Codigo_Barras/`: codigos de barras en PNG.
- `doc_exportados/`: documentos exportados.
- `Archivos/`: archivos anexos o auxiliares.
- `Conexion/subidas/`: archivos subidos.
- `pantallas/*.txt`: bitacoras, respaldos o exportaciones historicas.

## Resumen de servicios implementados

### Servicio de login

Valida la llave de acceso del usuario.

```text
ValidoKey
```

### Servicio FUP principal

Consulta, inserta y actualiza informacion de FUP.

```text
getConsulta
```

### Servicio de foliacion

Obtiene folios para documentos, especialmente cambio CT.

```text
getFolio
```

### SQL Server directo

Usado principalmente para permisos de menu.

```text
sqlsrv_connect
sqlsrv_query
```

## Observaciones tecnicas

- La aplicacion esta fuertemente acoplada al Web Service SOAP.
- Los IDs numericos de `Resultado` son centrales para entender el sistema.
- Hay URLs de pruebas y produccion dentro del codigo.
- Hay credenciales hardcodeadas en archivos PHP.
- Hay bastante duplicacion entre modulos principales y modulos de cambio.
- Muchas respuestas SOAP se procesan manualmente desde XML.
- No existe una capa unica de acceso a datos; cada endpoint arma su propia llamada.
- Hay varios archivos historicos, copias y pruebas dentro del proyecto.

## Recomendaciones de mejora

1. Mover credenciales y URLs a variables de entorno o archivo de configuracion fuera del webroot.
2. Crear una clase unica para consumir `getConsulta`.
3. Documentar en una tabla todos los IDs de `Resultado` y su significado.
4. Separar ambiente de pruebas y produccion mediante configuracion.
5. Unificar endpoints duplicados entre `pantallas` y `pantallas_cambio`.
6. Centralizar el parseo de respuestas SOAP/XML.
7. Evitar el uso de `ValidarKey3.php` en ambientes productivos.
8. Separar archivos generados del codigo fuente.

## Conclusion

El proyecto es una aplicacion PHP institucional para gestionar FUPs. Su logica principal depende de Web Services SOAP: uno para datos FUP y otro para foliacion. La base SQL Server se usa principalmente para permisos. La interfaz se construye con PHP, jQuery y Bootstrap, mientras que la generacion documental se realiza con FPDF/FPDI. El sistema esta funcionalmente dividido por carpetas, pero no por capas estrictas; por eso la logica de consulta, presentacion y procesamiento aparece repartida entre pantallas, endpoints AJAX y scripts de PDF.
