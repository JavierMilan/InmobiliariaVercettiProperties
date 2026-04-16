<?php
require_once 'config/conexion.php';

$query = "SELECT p.*, prop.nombre as propietario_nombre, prop.telefono, prop.email 
          FROM propiedades p 
          JOIN propietarios prop ON p.propietario_id = prop.id 
          WHERE 1=1";

$params = [];

// Filtro por ZONA
if (!empty($_GET['zona'])) {
    $query .= " AND p.zona = :zona";
    $params[':zona'] = $_GET['zona'];
}

// Filtro por TIPO DE INMUEBLE
if (!empty($_GET['tipo_inmueble'])) {
    $query .= " AND p.tipo_inmueble = :tipo_inmueble";
    $params[':tipo_inmueble'] = $_GET['tipo_inmueble'];
}

// Filtro por HABITACIONES (mínimo) - REQUISITO OBLIGATORIO
if (!empty($_GET['habitaciones'])) {
    $query .= " AND p.num_habitaciones >= :habitaciones";
    $params[':habitaciones'] = $_GET['habitaciones'];
}

// Filtro por PRECIO MÍNIMO - REQUISITO OBLIGATORIO
if (!empty($_GET['precio_min'])) {
    $query .= " AND p.precio >= :precio_min";
    $params[':precio_min'] = $_GET['precio_min'];
}

// Filtro por PRECIO MÁXIMO - REQUISITO OBLIGATORIO
if (!empty($_GET['precio_max'])) {
    $query .= " AND p.precio <= :precio_max";
    $params[':precio_max'] = $_GET['precio_max'];
}

// Filtro por FECHA DE CONSTRUCCIÓN (año mínimo) - REQUISITO OBLIGATORIO
if (!empty($_GET['año_min'])) {
    $query .= " AND YEAR(p.fecha_construccion) >= :anio_min";
    $params[':anio_min'] = $_GET['año_min'];
}

// Filtro por AMUEBLADA
if (!empty($_GET['amueblada'])) {
    $query .= " AND p.amueblada = 1";
}

// Ordenar por precio (menor a mayor por defecto)
$query .= " ORDER BY p.precio ASC";

// Ejecutar consulta
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$propiedades = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resultados - Vercetti Properties</title>
  
  <!-- CSS -->
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

  <!-- SECCIÓN DE RESULTADOS -->
  <section class="resultados-section">
    <div class="resultados-header">
      <p>
        <strong><?php echo count($propiedades); ?></strong>
        <span data-i18n="results.found">PROPERTIES FOUND</span>
      </p>

    </div>

    <div class="propiedades-grid">
      <?php if (empty($propiedades)): ?>
        <div class="no-resultados">
          <!--<img src="imagenes/vercettiTriste.png">-->
          <h2>No se encontraron propiedades</h2>
          
           <!-- <p>Intenta ajustar los filtros de búsqueda</p>-->
          <a href="index.php#buscar" class="btn-primary">Volver a buscar</a>
        </div>
      <?php else: ?>
        <?php foreach ($propiedades as $prop): ?>
          <article class="propiedad-card">
            <div class="propiedad-imagen-container">
              <img src="<?php echo htmlspecialchars($prop['imagen']); ?>" 
                   alt="<?php echo htmlspecialchars($prop['titulo']); ?>"
                   onerror="this.src='imagenes/default-property.jpg'">
              <?php if ($prop['amueblada']): ?>
                <span class="badge-amueblada">✓ Amueblada</span>
              <?php endif; ?>
            </div>
            
            <div class="propiedad-info">
              <h3><?php echo htmlspecialchars($prop['titulo']); ?></h3>
              <p class="zona"><?php echo htmlspecialchars($prop['zona']); ?></p>
              <p class="tipo"><?php echo htmlspecialchars($prop['tipo_inmueble']); ?></p>
              
              <p class="precio">$<?php echo number_format($prop['precio'], 0, ',', '.'); ?></p>
              
              <div class="caracteristicas">
                <?php if ($prop['num_habitaciones']): ?>
                  <span>🛏️ <?php echo $prop['num_habitaciones']; ?> hab.</span>
                <?php endif; ?>
                <span>📐 <?php echo $prop['metros_cuadrados']; ?> m²</span>
                <span>📅 <?php echo date('Y', strtotime($prop['fecha_construccion'])); ?></span>
              </div>

              <div class="propiedad-contacto">
                <small>Propietario: <?php echo htmlspecialchars($prop['propietario_nombre']); ?></small>
              </div>
              
              <a href="detalle.php?id=<?php echo $prop['id']; ?>" class="btn-ver-mas">
                Ver Detalles →
              </a>
            </div>
          </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>

 <?php include 'footer.php'; ?>
 <script src="scripts.js"></script>
 <script src="translations.js"></script> 
</body>
</html>
