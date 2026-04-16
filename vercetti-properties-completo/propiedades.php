<?php
require_once 'config/conexion.php';

// Obtener TODAS las propiedades
$query = "SELECT p.*, prop.nombre as propietario_nombre 
          FROM propiedades p 
          JOIN propietarios prop ON p.propietario_id = prop.id 
          ORDER BY p.zona, p.precio";
$stmt = $pdo->query($query);
$propiedades = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedades - Vercetti Properties</title>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="cabecera.css"/>
    <link rel="stylesheet" href="resultados.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&...&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="i18n.css"/>
</head>
 
<body>

  <!-- HEADER / NAV -->
  <header class="cabecera">
    <div class="logo">
      <img src="imagenes/vercettiLogoColor.png" alt="Vercetti Properties Logo" width="250px">
    </div>

    <nav class="cabeceraBotones">
     <ul>
        <li><a href="index.php" data-i18n="nav.home">Home</a></li>
        <li><a href="propiedades.php" data-i18n="nav.properties">Properties</a></li>
        <li><a href="index.php#about" data-i18n="nav.about">About</a></li>
        <li><a href="index.php#contact" data-i18n="nav.contact">Contact</a></li>
        <a href="index.php#buscar"><img src="imagenes/logoOpciones.png" width="50px" class="logoOpcionesBlack"></a></li>
      </ul>
    </nav>
    <button id="lang-toggle" aria-label="Switch to Spanish">ES</button>
      <button class="hamburger" aria-label="Abrir menú">
          <span></span>
          <span></span>
          <span></span>
      </button>
  </header>

  <!-- LISTADO COMPLETO DE PROPIEDADES -->
   
  <section class="resultados-section">
    <div class="resultados-header">
      <h1 data-i18n="props.title">PROPERTIES</h1>
    </div>

    <div class="propiedades-grid">
      <?php foreach ($propiedades as $prop): ?>
        <article class="propiedad-card">
          <div class="propiedad-imagen-container">
            <img src="<?php echo htmlspecialchars($prop['imagen']); ?>" 
                 alt="<?php echo htmlspecialchars($prop['titulo']); ?>"
                 onerror="this.src='imagenes/default-property.jpg'">
            <?php if ($prop['amueblada']): ?>
              <span class="badge-amueblada" data-i18n="props.furnished">✓ Furnished</span>
            <?php endif; ?>
          </div>
          <!--INFO PROPIEDAD-->
          <div class="propiedad-info">
            <!--DIV SUPERIOR-->
            <div class="propiedadInfoPrincipal">
              <h3><?php echo htmlspecialchars($prop['titulo']); ?></h3>

                <div class="contenedorZona">
                  <img src="imagenes/zona.png" class="logoZona">
                  <p class="zona"><?php echo htmlspecialchars($prop['zona']); ?></p>
                </div>
                <div class="contenedorPrecioTipo">
                 <p class="precio">$<?php echo number_format($prop['precio'], 0, ',', '.'); ?></p>
                 <p class="tipo"><?php echo htmlspecialchars($prop['tipo_inmueble']); ?></p>
                </div>
              
              
                <div class="caracteristicas">
                  <?php if ($prop['num_habitaciones']): ?>
                   <span>🛏️ <?php echo $prop['num_habitaciones']; ?> <span data-i18n="props.beds">hab.</span></span>
                  <?php endif; ?>
                  <span>📐 <?php echo $prop['metros_cuadrados']; ?> m²</span>
                  <span>📅 <?php echo date('Y', strtotime($prop['fecha_construccion'])); ?></span>
                </div>
            </div>
                
            <div class="propiedad-contacto">
              <small>
                <span data-i18n="props.owner">Owner:</span>
                <?php echo htmlspecialchars($prop['propietario_nombre']); ?>
              </small>
            </div>
            
            <a href="detalle.php?id=<?php echo $prop['id']; ?>" class="btn-ver-mas" data-i18n="props.details">
              Ver Detalles →
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

<?php include 'footer.php'; ?>
 <script src="scripts.js"></script>
 <script src="translations.js"></script> 
</body>
</html>
