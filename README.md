# Tema persolanizado para la pagina de Almacen De Camping Sas

## Infor general
Nombre del tema: Almacen de Camping Coustume
Desarrollador: Santiago Duque
Description: Tema de wordpress con el pluging de woocomerce persolanizado para Almacen De Camping Sas.
Version: 1.0.1

## Requerimientos
<ul>
  <li> Requiere MySQL: 8.4</li>
  <li> Requiere WordPress: 7.0 </li>
  <li> Requiere Apache: 2.4 </li>
  <li> Requiere PHP: 8.5 </li>
</ul>

## Compilar scss a css
Se usa el siguiente comando en la carpeta del tema:

``` bash
npm install sass --save-dev

sass --watch assets/scss/main.scss:assets/css/general.css

```

## Versiones:

- Version 1.0.0: Es la primera vercion de la pagina web funcional y disponible en la web

- Version 1.0.1: Se arreglo un bug en el header, cuando el usuario no estaba LogedIn salia el boton de carrito, y al acceder, salia un error. En este momento se paso el boton de carrito a que solo este visible cuando el susuario halla iniciado secion.