# AGENTS.md

## 1. Objetivo del proyecto

Este repositorio contiene el código fuente del sitio público de Ómnibus Yahualica Guadalajara.

El objetivo de los cambios es modernizar, mantener y ampliar el sitio sin afectar su funcionamiento actual, sus rutas públicas, la consulta de corridas ni la integración con la base de datos.

## 2. Fuente de verdad

Antes de modificar cualquier archivo:

1. Revisa el código real relacionado con la tarea.
2. Identifica archivos llamadores, `include`, rutas, dependencias y estilos relacionados.
3. Conserva los nombres, parámetros, respuestas y comportamientos existentes salvo autorización expresa.
4. No inventes archivos, funciones, tablas, columnas, rutas ni reglas de negocio.
5. Cuando algo no pueda confirmarse, indícalo como `Pendiente por confirmar`.

## 3. Tecnologías y restricciones

El proyecto utiliza principalmente:

- PHP puro, sin framework de backend.
- HTML5.
- CSS propio.
- JavaScript y jQuery existentes.
- Bootstrap 4.6.1 en el estado actual del repositorio.
- Select2 y DataTables.
- MySQL mediante PDO.

Reglas:

- No agregar frameworks de frontend o backend.
- No agregar React, Vue, Angular, Laravel, Symfony, Tailwind ni equivalentes.
- Las mejoras visuales deben realizarse con HTML, CSS y JavaScript puro.
- Se pueden conservar temporalmente las librerías existentes mientras se prepara una migración controlada.
- No actualizar Bootstrap ni otras dependencias sin revisar primero todos sus consumidores.

## 4. Identidad visual

Debe conservarse la identidad institucional actual:

- Vino principal: `#3B1222`.
- Amarillo de acento: `#FBB900`.
- Blanco: `#FFFFFF`.
- Grises neutros como colores complementarios.

La modernización debe transmitir:

- seguridad;
- confianza;
- movilidad;
- cercanía regional;
- comodidad del pasajero;
- claridad para comprar boletos y consultar corridas.

No cambiar logotipos, colores institucionales ni mensajes comerciales sin autorización.

## 5. Principios de frontend

Toda mejora visual debe:

- diseñarse primero para dispositivos móviles;
- funcionar correctamente en celular, tableta y escritorio;
- evitar alturas y anchos rígidos cuando no sean necesarios;
- usar HTML semántico;
- mantener contraste suficiente y foco visible;
- permitir navegación con teclado;
- incluir textos alternativos adecuados en imágenes;
- respetar `prefers-reduced-motion` para animaciones;
- evitar animaciones excesivas;
- evitar estilos en línea cuando puedan trasladarse a CSS;
- reutilizar clases y componentes existentes antes de duplicar código.

## 6. Alcance de las modificaciones

Realiza cambios pequeños y revisables.

Antes de modificar:

1. Indica el archivo.
2. Explica brevemente el objetivo.
3. Identifica el bloque o líneas aproximadas.
4. Señala riesgos y dependencias relevantes.

Después de modificar:

1. Resume los cambios realizados.
2. Indica las pruebas ejecutadas.
3. Señala pruebas pendientes.
4. No afirmes que algo funciona si no fue probado.

No mezcles en un mismo cambio:

- rediseño visual;
- refactorización de backend;
- cambios de base de datos;
- correcciones de seguridad no relacionadas;
- actualización masiva de dependencias.

## 7. Seguridad

Está prohibido agregar al repositorio:

- contraseñas;
- credenciales de base de datos;
- llaves privadas;
- tokens;
- secretos de correo;
- archivos `.env` con datos reales;
- respaldos de producción con información sensible.

Utiliza variables de entorno o archivos locales ignorados por Git.

Para consultas SQL nuevas o modificadas:

- utiliza sentencias preparadas con parámetros enlazados;
- no concatena directamente datos de `GET`, `POST`, sesiones o cookies;
- escapa la salida según el contexto HTML, atributo, URL o JavaScript.

No cambies la lógica de seguridad existente durante una tarea puramente visual, salvo que el problema impida realizar el trabajo de forma segura. En ese caso, informa el bloqueo.

## 8. Rendimiento

Para el frontend:

- optimiza imágenes antes de agregar nuevas;
- prefiere WebP o AVIF cuando sea compatible con el flujo del proyecto;
- define `width` y `height` para evitar movimientos de diseño;
- utiliza carga diferida en imágenes fuera del primer bloque visible;
- evita cargar librerías en páginas que no las utilizan;
- minimiza JavaScript innecesario;
- no agregues videos de fondo pesados sin autorización.

## 9. Compatibilidad

Antes de cambiar un archivo compartido como `header.php`, `nav.php`, `datatables.php` o `css/general.css`:

1. Identifica todas las páginas que lo incluyen.
2. Revisa posibles efectos indirectos.
3. Conserva las rutas relativas existentes o actualízalas de forma controlada.
4. Prueba al menos la portada, la consulta de corridas y la navegación móvil.

## 10. Pruebas mínimas del frontend

En cada cambio visual verifica:

- ancho aproximado de 360 px;
- ancho aproximado de 768 px;
- ancho de 1366 px o superior;
- menú móvil;
- enlaces y botones principales;
- carrusel o bloque principal;
- legibilidad de textos;
- ausencia de desplazamiento horizontal;
- carga correcta de imágenes;
- consola del navegador sin errores nuevos.

Cuando PHP esté disponible, ejecuta validación de sintaxis en cada archivo PHP modificado:

```bash
php -l ruta/del/archivo.php
```

## 11. Git

- Trabaja en una rama separada para cambios importantes.
- No modifiques directamente `master` salvo instrucción explícita.
- Usa commits pequeños y descriptivos.
- No combines archivos no relacionados en el mismo commit.
- No hagas `push`, `merge` o publicación a producción sin autorización.
- Revisa `git diff` antes de confirmar cambios.

Formato recomendado de commits:

```text
feat(frontend): descripción breve
fix(frontend): descripción breve
docs: descripción breve
refactor(frontend): descripción breve
```

## 12. Comunicación de cambios

Presenta las propuestas y modificaciones en lenguaje sencillo.

Para cambios manuales indica:

```text
Archivo:
Líneas aproximadas:
Acción:
Código:
Prueba:
```

Cuando el usuario confirme `cambio aplicado`, toma el nuevo estado como referencia y ajusta las líneas aproximadas para cambios posteriores.
