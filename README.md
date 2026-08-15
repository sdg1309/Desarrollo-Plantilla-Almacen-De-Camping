# Tema personalizado para Almacén de Camping SAS

## Información general
- Nombre del tema: Almacén de Camping Custom
- Desarrollador: Santiago Duque
- Descripción: Tema personalizado de WordPress para Almacén de Camping SAS, con soporte para WooCommerce y estilos propios para la tienda y el sitio principal.
- GitHub: https://github.com/sdg1309/Desarrollo-Plantilla-Almacen-De-Camping
- Versión: 1.0.4

## Características principales
- Diseño personalizado para la identidad visual del negocio.
- Integración con WooCommerce para tienda online.
- Estilos organizados con Sass.
- Estructura preparada para páginas de inicio, productos, carrito y checkout.
- Compatibilidad con navegación, galerías de productos y búsqueda Ajax.

## Requisitos
- WordPress 5.6 o superior
- PHP 7.4 o superior
- WooCommerce instalado y configurado
- MySQL 5.7 o superior
- Servidor Apache o Nginx

## Desarrollo y compilación de estilos
El tema utiliza Sass para generar los estilos principales. Desde la carpeta del tema, puedes ejecutar:

```bash
npm install sass --save-dev
npx sass --watch assets/scss/main.scss:assets/css/general.css
```

Esto compilará los archivos SCSS en `assets/css/general.css`.

## Estructura del tema
- `assets/scss/`: archivos fuente de estilos Sass.
- `assets/css/`: archivos CSS compilados.
- `assets/js/`: scripts para navegación, carrusel, galería de productos y búsqueda.
- `woocommerce/`: plantillas personalizadas para WooCommerce.

## Autor
- Santiago Duque

## Notas
Este tema está pensado para uso específico del proyecto de Almacén de Camping SAS y puede adaptarse según nuevas necesidades del negocio.