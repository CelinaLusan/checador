# cadxelaTorneoDeFutbol
Proyecto con base a la participación en el proyecto de desarrollo global de software

### Tecnologías ocupadas
* HTML 5  
* CSS 3  
* JavaScript
* XAMMP(Apache, MySQL, PHP)

### Tablero con tareas asignadas

http://cadxelagsd.herokuapp.com/sprint

### Estándar de codificación

# 1. Estándar de codificación

Este estándar de codificación define un estilo de programación homogéneo que será utilizado para el desarrollo de los proyectos en Cadxela GSD.

# 1.1. Organización de los archivos

Cada archivo de código fuente deberá contener:

 * Un encabezado.
 * Sentencias de importación (e.g., include, import)
 * Definición de la clase o función principal
 
# 1.2. Encabezado del programa

Empezar todas las clases con el siguiente encabezado:

# /**
# * Autor: Alberto González
# **/
# /**
* Resumen: Una breve descripción de la funcionalidad de la clase
**/

# 1.3. Definición de las clases

Cada una de las clases definidas en los proyectos deberán empezar con una letra mayúscula: class Car, class Person, etc.

# 1.4. Definición de métodos y funciones

Cada método o función definida dentro del código deberá iniciar con una descripción de los parámetros de entrada y las salidas que ésta produce:

# /**
# *
# * Autor: María Méndez
# * Entrada a: primer operando de la suma
# * Entrada b: segundo operando de la suma
# * Salida c: resultado de la suma
# **/
# private int sum(int a, int b){
# return a + b;
# }

Aunado a lo anterior, cada nombre de método o función deberá iniciar con una letra en minúscula. Para el caso en que los nombres de los métodos o funciones contengan más de una palabra, la segunda deberá comenzar con una letra en mayúscula: 

# private int getMinimum(int a, int b). 

Finalmente:

* No hay espacio entre el nombre del método, el paréntesis y la lista de parámetros.
* Se abre la llave { al final de la misma línea que la declaración.
* La llave de } debe aparecer en línea aparte con la misma indentación que el método o clase que cierra.

# 1.5. Indentación

La unidad de indentación de bloques de sentencias son 4 espacios.

# 1.6. Declaraciones

Se debe declarar cada variable en una línea distinta, de esta forma cada variable se puede comentar por separado. 
Ejemplo:

# int level, size; // Mal
# int level; // Indentation level
# int size; // Size of table

# 1.7. Sentencias

Cada línea debe contener una sola sentencia. Ejemplos:

# argv++; // Bien
# argc++; // Bien
# argv++; argc++; // Mal

# 1.8. Espacios en blanco

Se deben utilizar un espacio en blanco entre la definición de métodos:

# /**
# *
# * Autor: Aurora López
# * Salida name: el nombre del usuario
# **/
# private string getName(){
#     return this.name;
# }
# /**
# *
# * Autor: Pedro Fernández
# * Entrada name: el nombre que se establecerá para el usuario
# **/
# private void setName(string name){
#  this.name = name;
# }

# 1.9. Definición de nombres

Se deben usar descriptores en inglés que aclaren el cometido de la variable, método o clase.

* Se debe usar terminología aplicable al dominio.
* Si se usan abreviaturas hay que mantener en algún sitio una lista de lo que éstas significan.
* Evitar en lo posible los nombres largos (menos de 15 letras sería lo ideal).
* Evitar nombres que difieran en una letra o en el uso de mayúsculas.
* Un nombre no debería constar de más de dos palabras.
* No usar siglas en los nombres a menos que queden muy largos o sean siglas conocidas por todos.
* Las constantes se escriben todas en mayúsculas.

# 1.10. Código reutilizado o modificado

Cuando se reutilice el código se deberá indicar si se realizaron cambios o se utilizó sin estos:

# /**
# * Autor: Osvaldo García
# * Contenido modificado en 12/03/2019
# */
# /**
# * Autor: Osvaldo García
# * Contenido reutilizado sin cambios en 12/03/2019
# */
