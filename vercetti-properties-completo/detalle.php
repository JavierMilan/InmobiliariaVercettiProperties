<?php
require_once 'config/conexion.php';

// Validar que se recibió un ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];

// Obtener la propiedad específica
$query = "SELECT p.*, prop.nombre as propietario_nombre, prop.telefono, prop.email 
          FROM propiedades p 
          JOIN propietarios prop ON p.propietario_id = prop.id 
          WHERE p.id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$propiedad = $stmt->fetch();

// Si no existe la propiedad, redirigir
if (!$propiedad) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($propiedad['titulo']); ?> - Vercetti Properties</title>
  
  <link rel="stylesheet" href="styles.css"/>
  <link rel="stylesheet" href="cabecera.css"/>
  <link rel="stylesheet" href="detalle.css"/>
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
        <!--<li><a href="javascript:history.back()" class="btn-volver">← Volver</a></li>-->
        <li><a href="index.php" data-i18n="nav.home">Home</a></li>
        <li><a href="propiedades.php" data-i18n="nav.properties">Properties</a></li>
        <li><a href="index.php#about" data-i18n="nav.about">About</a></li>
        <li><a href="index.php#contact" data-i18n="nav.contact">Contact</a></li>
        <a href="index.php#buscar"><img src="imagenes/logoOpciones.png" width="50px" class="logoOpciones"></a></li>
      </ul>
    </nav>
    <button id="lang-toggle" aria-label="Switch to Spanish">ES</button>
      <button class="hamburger" aria-label="Abrir menú">
        <span></span>
        <span></span>
        <span></span>
      </button>
  </header>

  <!-- DETALLE DE LA PROPIEDAD -->
  <section class="detalle-section">
    <div class="detalle-container">
      <div class="contenedorIzquierdo">

          <div class="detalle-grid">

            <!-- Imagen Principal -->
            <div class="detalle-imagen">
              <img src="<?php echo htmlspecialchars($propiedad['imagen']); ?>" 
              alt="<?php echo htmlspecialchars($propiedad['titulo']); ?>"
              onerror="this.src='imagenes/default-property.jpg'">
              <?php if ($propiedad['amueblada']): ?>
                <span class="badge-destacado" data-i18n="detail.furnished">✓ FURNISHED</span>
              <?php endif; ?>
            </div>
          </div> <!-- fin detalle-grid -->

           <!-- Información de Contacto -->
            <div class="contacto-box">
              <h4 data-i18n="detail.contact.title">Contact Information</h4>
              <div class="contacto-info">
                  <p><strong data-i18n="detail.contact.owner">Owner:</strong> <?php echo htmlspecialchars($propiedad['propietario_nombre']); ?></p>
                  <p><strong data-i18n="detail.contact.phone">Phone:</strong> <a href="tel:<?php echo htmlspecialchars($propiedad['telefono']); ?>"><?php echo htmlspecialchars($propiedad['telefono']); ?></a></p>
                  <p><strong data-i18n="detail.contact.email">Email:</strong> <a href="mailto:<?php echo htmlspecialchars($propiedad['email']); ?>"><?php echo htmlspecialchars($propiedad['email']); ?></a></p>
              </div>
              <button class="btn-contactar" data-i18n="detail.contact.btn" onclick="window.location.href='mailto:<?php echo htmlspecialchars($propiedad['email']); ?>'">
                Contact the owner
              </button>
            </div>
      </div> <!-- fin contenedorIzquierdo -->

      
          <!-- Información Principal -->
          <div class="detalle-info">
                <!--Titulo y zona-->
            <div class="detalle-header">
                <h1><?php echo htmlspecialchars($propiedad['titulo']); ?></h1> 
              <p class="detalle-zona"><?php echo htmlspecialchars($propiedad['zona']); ?>, Vice City</p>
            </div>

            <div class="precio-destacado">
              <span class="label" data-i18n="detail.price.label">Price</span>
              <span class="precio-grande">$<?php echo number_format($propiedad['precio'], 0, ',', '.'); ?></span>
            </div>

             <!-- Descripción -->
            <?php if ($propiedad['descripcion']): ?>
            <div class="descripcion-box">
                <p data-i18n-desc="<?php echo $propiedad['id']; ?>">
                <?php echo nl2br(htmlspecialchars($propiedad['descripcion'])); ?>
                </p>
            </div>
            <?php endif; ?>

            <div class="caracteristicas-principales">
              <div class="caracteristica">
                <div>
                  <strong data-i18n-tipo="<?php echo htmlspecialchars($propiedad['tipo_inmueble']); ?>">
                    <?php echo htmlspecialchars($propiedad['tipo_inmueble']); ?>
                  </strong>
                  <small data-i18n="detail.type.label">Property type</small>
                </div>
              </div>

              <?php if ($propiedad['num_habitaciones']): ?>
              <div class="caracteristica">
              
                <div>
                  <strong><?php echo $propiedad['num_habitaciones']; ?> <span data-i18n="detail.beds.label">habitaciones</span></strong>
                  <small data-i18n="detail.beds.sub">Rooms to rest</small>
                </div>
              </div>
              <?php endif; ?>

              <div class="caracteristica">
             
                <div>
                  <strong><?php echo $propiedad['metros_cuadrados']; ?> m²</strong>
                  <small data-i18n="detail.area.sub">Total area</small>
                </div>
              </div>

              <div class="caracteristica">
           
                <div>
                  <strong><?php echo date('Y', strtotime($propiedad['fecha_construccion'])); ?></strong>
                  <small data-i18n="detail.year.sub">Year built</small>
                </div>
              </div>

             <!-- <div class="caracteristica">
                <span class="icono"><?php echo $propiedad['amueblada'] ? '✅' : '❌'; ?></span>
                <div>
                  <strong><?php echo $propiedad['amueblada'] ? 'Amueblada' : 'Sin amueblar'; ?></strong>
                  <small>Estado del mobiliario</small>
                </div>-->
              </div>
            </div>

          </div> <!-- fin detalle-info -->

    </div> <!-- fin detalle-container -->
  </section>

  <?php include 'footer.php'; ?>

  <script src="scripts.js"></script>
  <script src="translations.js"></script> 
</body>
</html>