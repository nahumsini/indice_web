# Carpeta de Imágenes - Índice Web

Esta carpeta contiene todos los assets visuales del sitio web.

## 📁 Estructura Recomendada

```
imgs/
├── logo-indice.png           # Logo principal (recomendado: 200x60px)
├── logo-indice-white.png     # Logo blanco para footer (200x60px)
├── favicon.png               # Favicon (32x32px o 64x64px)
├── hero-bg.jpg              # Imagen de fondo para hero (1920x1080px)
├── team-illustration.svg     # Ilustración del equipo (vectorial)
├── modulos/                 # Iconos de módulos
│   ├── gastos-icon.svg
│   ├── inventarios-icon.svg
│   ├── rrhh-icon.svg
│   └── ...
├── testimonials/           # Fotos de testimoniales
│   ├── cliente1.jpg
│   ├── cliente2.jpg
│   └── ...
└── screenshots/           # Capturas de la aplicación
    ├── dashboard.png
    ├── modulo-gastos.png
    └── ...
```

## 🎨 Especificaciones de Diseño

### Colores Principales
- **Azul Primario**: #193755
- **Amarillo Primario**: #F2C94C
- **Gris Secundario**: #f9f9f9

### Logos
- **Formato**: PNG con transparencia
- **Tamaño logo principal**: 200x60px (proporción 10:3)
- **Logo blanco**: Para uso en fondos oscuros
- **Favicon**: 32x32px, 64x64px y formato ICO

### Imágenes Optimizadas
- **Formato**: WebP cuando sea posible, JPEG para fotos, PNG para gráficos
- **Compresión**: Optimizar para web (calidad 80-90%)
- **Responsive**: Considerar diferentes tamaños para dispositivos

## 🚀 Implementación

### En el código HTML/PHP:
```html
<!-- Logo principal -->
<img src="imgs/logo-indice.png" alt="Índice" class="img-fluid">

<!-- Logo en footer -->
<img src="imgs/logo-indice-white.png" alt="Índice" class="footer-logo">

<!-- Favicon en header.php -->
<link rel="icon" type="image/png" href="imgs/favicon.png">
```

### Lazy Loading:
```html
<img data-src="imgs/hero-bg.jpg" alt="Hero" class="lazy">
```

## 📱 Responsive Images

Usar diferentes tamaños para mejor performance:

```html
<picture>
  <source media="(max-width: 768px)" srcset="imgs/logo-mobile.png">
  <source media="(max-width: 1200px)" srcset="imgs/logo-tablet.png">
  <img src="imgs/logo-desktop.png" alt="Índice">
</picture>
```

## 🔧 Herramientas de Optimización

### Recomendadas:
- **TinyPNG**: Para comprimir PNG y JPEG
- **Squoosh**: Editor de imágenes web de Google
- **ImageOptim**: Para macOS
- **GIMP/Photoshop**: Para edición profesional

### Online:
- https://tinypng.com/
- https://squoosh.app/
- https://compressor.io/

## 📋 Checklist de Imágenes

- [ ] Logo principal (PNG, 200x60px)
- [ ] Logo blanco (PNG, 200x60px) 
- [ ] Favicon (PNG/ICO, 32x32px)
- [ ] Imagen hero (JPEG optimizado, 1920x1080px)
- [ ] Iconos de módulos (SVG preferible)
- [ ] Fotos testimoniales (JPEG, 300x300px)
- [ ] Screenshots aplicación (PNG optimizado)
- [ ] Todas las imágenes optimizadas para web
- [ ] Alt text definido para accesibilidad

## 🎯 SEO y Accesibilidad

### Alt Text:
- Describir el contenido de la imagen
- Mantener entre 10-15 palabras
- Incluir palabras clave relevantes cuando sea natural

### Nombres de Archivo:
- Usar nombres descriptivos
- Separar palabras con guiones
- Ejemplo: `dashboard-control-gastos.png`

## 📊 Performance

### Tamaños Recomendados:
- **Logos**: Máximo 50KB
- **Hero images**: Máximo 200KB
- **Iconos SVG**: Máximo 10KB
- **Screenshots**: Máximo 150KB

### Formatos por Uso:
- **Logos**: PNG (transparencia)
- **Fotos**: JPEG (mejor compresión)
- **Iconos**: SVG (escalable)
- **Gráficos simples**: PNG

---

**Nota**: Recuerda actualizar las rutas en el código cuando agregues nuevas imágenes.
