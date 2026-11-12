# Funcionamiento del Proyecto para Usuario Nuevo

## Objetivo del sistema

El sistema Formato Unico Personal, FUP, permite consultar movimientos de personal, revisar antecedentes, generar documentos PDF, autorizar FUPs, rechazarlos, reimprimirlos y dar seguimiento a documentos pendientes.

Esta guia explica el funcionamiento desde la perspectiva de un usuario nuevo, usando un caso de ejemplo de FUP Cambio CT.

## Datos de ejemplo

Para esta guia se usaran estos datos:

| Campo | Valor |
| --- | --- |
| Documento | `2516000001` |
| Num Oficio | `1231034928` |
| RFC | `ZAMJ830408DMA` |
| Plaza | `072413A0180300.0100032` |
| Area | `1 - SECRETARIA PARTICULAR` |
| CT Nuevo | `24ADG0002Y` |
| CT Anterior | `24ADG0010F` |

## Entrada al sistema

Normalmente el usuario entra al sistema desde el login institucional. El login envia una llave llamada `key` al sistema FUP.

El flujo esperado es:

```text
Login institucional
  -> envia key
  -> index.php recibe key
  -> se valida la sesion
  -> se cargan permisos
  -> se muestra el menu correspondiente
```

## Como funciona `ValidarKey3.php`

El archivo `ValidarKey3.php` actualmente funciona como una validacion fija o de pruebas.

Su contenido asigna directamente:

```php
$usuario = "Jonathan";
$app = "1164";
$keys = "key";
```

Eso significa que no consulta el servicio real de login. Solo define un usuario, una aplicacion y una key falsa para que el sistema pueda cargar.

## Donde se usa `ValidarKey3.php`

En el estado actual del proyecto, `index.php` incluye directamente:

```php
include('ValidarKey3.php');
```

Esto ocurre despues de cargar el WSDL principal y antes de consultar permisos.

El flujo actual de `index.php` es:

```text
1. Carga Conexion/wsdl.php
2. Inicializa usuario y app vacios
3. Incluye ValidarKey3.php
4. Carga Conexion/conexion.php
5. Carga Conexion/permisos.php
6. Consulta permisos con usuario Jonathan y app 1164
7. Dibuja el menu
```

En otras palabras: actualmente no hay una condicional que decida usar `ValidarKey3.php`. Se usa siempre que se entra por `index.php`.

## Como deberia condicionarse `ValidarKey3.php`

Si `ValidarKey3.php` se quiere usar solo en local o pruebas, deberia existir una condicion.

Ejemplo conceptual:

```php
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    include('ValidarKey3.php');
} else {
    include('ValidarKey.php');
}
```

Otra opcion seria usar una variable de configuracion:

```php
if ($ambiente === 'desarrollo') {
    include('ValidarKey3.php');
} else {
    include('ValidarKey.php');
}
```

La idea es:

- En desarrollo: usar `ValidarKey3.php`.
- En produccion: usar `ValidarKey.php`.

`ValidarKey.php` si valida la key contra el Web Service institucional de login.

## Permisos del usuario

Despues de definir el usuario, el sistema consulta permisos en SQL Server.

El archivo responsable es:

```text
Conexion/permisos.php
```

El metodo usado es:

```php
$ObjetosPermisos->Menu($app, $usuario, $con);
```

Con el caso actual, se consulta el menu para:

```text
usuario: Jonathan
app: 1164
```

Segun los permisos encontrados, se muestran opciones como:

- Inicio.
- FUP.
- FUP Manual.
- FUP Cambio CT.
- FUP CCT 90.
- FUP CCT Pendientes.
- Pendientes.
- Autorizados.
- Reimpresion.
- Reportes.

## Flujo general como usuario

Un usuario nuevo normalmente trabajara asi:

```text
1. Entrar al sistema.
2. Elegir una opcion del menu.
3. Buscar registros por documento, RFC, oficio, area o filtro disponible.
4. Revisar los datos encontrados.
5. Abrir un previo si es necesario.
6. Crear el FUP.
7. Verificar el PDF generado.
8. Autorizar o dejar pendiente segun el rol del usuario.
9. Consultar o reimprimir el documento cuando ya exista.
```

## Flujo FUP Cambio CT

El modulo principal para el caso de ejemplo es:

```text
FUP CAMBIO CT
```

En el menu, al dar clic en `FUP CAMBIO CT`, `index.php` carga dentro de un iframe:

```text
pantallas/FUP_CambioCT.php?usuario=Jonathan
```

Este modulo muestra una tabla con columnas como:

- Crear.
- Previo.
- Documento.
- Num Oficio.
- RFC.
- Plaza.
- Area.
- CT Nuevo.
- CT Anterior.
- Ver FUP.

Con los datos del ejemplo, el usuario debe identificar una fila similar a:

| Documento | Num Oficio | RFC | Plaza | Area | CT Nuevo | CT Anterior |
| --- | --- | --- | --- | --- | --- | --- |
| `2516000001` | `1231034928` | `ZAMJ830408DMA` | `072413A0180300.0100032` | `1 - SECRETARIA PARTICULAR` | `24ADG0002Y` | `24ADG0010F` |

## Que hace internamente la tabla de Cambio CT

La tabla principal se alimenta desde:

```text
pantallas/data_cambio_CT.php
```

Ese archivo llama al Web Service principal usando:

```text
Resultado: 1267
```

El Web Service devuelve los registros y el sistema los muestra en la tabla.

Los campos que se esperan del servicio son:

- `num_docto`
- `num_oficio`
- `rfc`
- `plaza`
- `area`
- `ctnvo`
- `ct_anterior`
- `area_hide`
- `idAutorizar`

## Consultar antecedentes o registros previos

Dentro del modulo FUP Cambio CT existe un modal de gestion. En ese modal se puede elegir un filtro:

- `Actuales`
- `Todos`
- `Todos Sin Numero Documento`
- `Historico de Plazas del Movimiento`
- `Historico Otras Plazas`
- `Por Documento`

Para el ejemplo, si el usuario quiere buscar directamente por documento:

1. Seleccionar `Por Documento`.
2. Escribir:

```text
2516000001
```

3. Presionar `Ver Registros`.

Internamente se llama a:

```text
Pdf/AntecedentesPrevio.php
```

Ese archivo consulta el Web Service segun el filtro seleccionado.

IDs observados:

- `Actuales`: `1281`
- `Todos`: `1284`
- `Todos Sin Numero Documento`: `1285`
- `Historico`: `1286`
- `Historico Otras Plazas`: `1286`
- `Por Documento`: `1287`

## Seleccionar registros para crear FUP

Despues de ver registros, el usuario puede agregarlos a la tabla de seleccion.

El flujo visual es:

```text
Ver Registros
  -> revisar filas
  -> clic en Agregar
  -> la fila pasa a la tabla de seleccion
```

La tabla de seleccion representa los movimientos que se van a incluir en el FUP.

Si el usuario se equivoca, puede eliminar una fila seleccionada usando el boton de eliminar.

## Crear el FUP

Cuando ya estan seleccionados los registros correctos:

1. Revisar que el documento sea:

```text
2516000001
```

2. Confirmar que el RFC sea:

```text
ZAMJ830408DMA
```

3. Confirmar el cambio:

```text
CT anterior: 24ADG0010F
CT nuevo: 24ADG0002Y
```

4. Capturar observaciones si aplica.
5. Presionar `Crear FUP`.

En el codigo, este proceso termina llamando a scripts dentro de:

```text
Pdf/crearPDF/
```

Para Cambio CT, los archivos principales son:

```text
Pdf/crearPDF/CrearFUP_CambioCT.php
Pdf/crearPDF/CrearFUP_CambioCT_manual.php
Pdf/crearPDF/CrearFUP_CambioCT_Pendientes.php
```

Durante la creacion, el sistema puede usar:

- Web Service principal para consultar e insertar datos.
- Web Service de foliacion para obtener folio.
- FPDF/FPDI para construir el PDF.
- Logos y sellos desde `Logo/`.
- Codigos de barras desde `Codigo_Barras/`.

## Ver previo o PDF

En la tabla principal del modulo hay botones como:

- `Previo`
- `FUP`

El boton `Previo` permite revisar la informacion antes de generar o autorizar.

El boton `FUP` intenta abrir el documento PDF ya generado.

Si el PDF no existe, el sistema muestra un aviso indicando que no hay archivo PDF.

## Autorizar

El modulo FUP Cambio CT tambien tiene un boton:

```text
Autorizar
```

El usuario debe:

1. Seleccionar uno o varios registros.
2. Presionar `Autorizar`.
3. Confirmar la accion si el sistema lo solicita.

Internamente se arma un conjunto de documentos seleccionados y se envia al backend para actualizar el estatus mediante el Web Service.

## Que debe revisar el usuario antes de autorizar

Antes de autorizar el caso de ejemplo, revisar:

- Documento correcto: `2516000001`.
- Oficio correcto: `1231034928`.
- RFC correcto: `ZAMJ830408DMA`.
- Plaza correcta: `072413A0180300.0100032`.
- Area correcta: `1 - SECRETARIA PARTICULAR`.
- CT anterior correcto: `24ADG0010F`.
- CT nuevo correcto: `24ADG0002Y`.
- PDF generado y legible.
- Observaciones correctas, si fueron capturadas.

## Pendientes de Cambio CT

Tambien existe la opcion:

```text
FUP CCT Pendientes
```

Desde `index.php` se carga:

```text
pantallas/FUP_CambioCT_Pendientes.php
```

Esta pantalla sirve para revisar registros que ya estan en flujo pendiente y continuar con su autorizacion o generacion.

## FUP CCT 90

Existe una variante:

```text
FUP CCT 90
```

Desde `index.php` se carga:

```text
pantallas/FUP_CambioCT90.php
```

Funciona como una variante del flujo Cambio CT, pero con consultas y generacion especificas para ese tipo de proceso.

## Flujo explicado con los datos del ejemplo

Caso: cambiar el CT del trabajador con RFC `ZAMJ830408DMA`.

1. Entrar al sistema.
2. Abrir el menu `FUP CAMBIO CT`.
3. Buscar en la tabla el documento `2516000001`.
4. Confirmar que el oficio sea `1231034928`.
5. Confirmar que la plaza sea `072413A0180300.0100032`.
6. Confirmar que el area sea `1 - SECRETARIA PARTICULAR`.
7. Confirmar que el CT anterior sea `24ADG0010F`.
8. Confirmar que el CT nuevo sea `24ADG0002Y`.
9. Usar `Previo` para revisar el contenido.
10. Si falta seleccionar antecedentes, abrir gestion, usar filtro `Por Documento` y buscar `2516000001`.
11. Agregar los registros correctos a la tabla de seleccion.
12. Capturar observaciones si aplica.
13. Presionar `Crear FUP`.
14. Abrir el PDF con `FUP`.
15. Revisar que el PDF coincida con los datos.
16. Seleccionar el registro.
17. Presionar `Autorizar` si el rol del usuario lo permite.

## Resultado esperado

Al terminar correctamente:

- El FUP queda generado como PDF.
- El documento queda registrado en el flujo.
- El usuario puede abrirlo desde `Ver FUP`.
- Si fue autorizado, pasa al siguiente estado correspondiente.
- Si falta autorizacion, queda visible en la pantalla de pendientes correspondiente.

## Que hacer si no aparece el registro

Si no aparece el documento `2516000001`:

1. Revisar que el modulo correcto sea `FUP CAMBIO CT`.
2. Revisar si esta en `FUP CCT Pendientes`.
3. Buscar por `Por Documento`.
4. Buscar por RFC `ZAMJ830408DMA`.
5. Confirmar que el Web Service este disponible.
6. Confirmar que el usuario tenga permisos.
7. Confirmar que el registro exista en el ambiente actual, pruebas o produccion.

## Que hacer si no abre el PDF

Si al presionar `FUP` aparece que no hay PDF:

1. Revisar si el FUP ya fue creado.
2. Crear el FUP desde el modal de gestion.
3. Revisar si el archivo existe en la carpeta local de salida.
4. Confirmar que el numero de documento y oficio coincidan.
5. Intentar desde la pantalla de reimpresion o autorizados.

## Nota sobre pruebas realizadas

La revision se hizo siguiendo el flujo del codigo como lo haria un usuario normal:

- entrada por `index.php`.
- carga de `ValidarKey3.php`.
- consulta de permisos.
- menu `FUP CAMBIO CT`.
- tabla de Cambio CT.
- busqueda de antecedentes.
- seleccion de movimientos.
- creacion de FUP.
- visualizacion y autorizacion.

No se ejecuto una prueba completa contra el Web Service real desde aqui, porque el sistema depende de servicios SOAP externos, SQL Server institucional y permisos de red. La guia describe el comportamiento esperado segun el codigo actual del proyecto.
