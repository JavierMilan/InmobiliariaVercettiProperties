<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vercetti Properties | Luxury Real Estate</title>
  <meta name="description" content="Vercetti Properties – Luxury real estate inspired by Vice City lifestyle." />

  <!-- CSS -->
  <link rel="stylesheet" href="styles.css"/>
  <link rel="stylesheet" href="cabecera.css"/>
  <link rel="stylesheet" href="hall.css"/>
  <link rel="stylesheet" href="formulario.css"/>
  <link rel="stylesheet" href="hotProperties.css"/>
  <link rel="stylesheet" href="mapa.css"/>
  <link rel="stylesheet" href="about.css"/>
  <link rel="stylesheet" href="contacto.css"/>
  <link rel="stylesheet" href="i18n.css"/>

  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Raleway:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
        
</head>
<!-- BODY -->
<body>
  
<!-- SECCIÓN HALL -->
<section id="home" class="hall">
  <!-- HEADER / NAV -->
  <header class="cabecera">
    <div class="logo">
        <img src="imagenes/vercettiLogoColor.png" alt="Vercetti Properties Logo" width="265px">
    </div>
    

    <nav class="cabeceraBotones">
       <ul>
        <li><a href="index.php" data-i18n="nav.home">Home</a></li>
        <li><a href="propiedades.php" data-i18n="nav.properties">Properties</a></li>
        <li><a href="index.php#about" data-i18n="nav.about">About</a></li>
        <li><a href="#contact" data-i18n="nav.contact">Contact</a></li>
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

  <!-- CONTENIDO HALL -->
  <div class="hallContenido">
    <p data-i18n="hall.slogan">We don't sell Houses,<br>We sell Lifestyles.</p>
  </div>
</section>
<!-- FIN SECCIÓN HALL -->

<!-- SECCIÓN FORMULARIO -->
<section class="formulario-section" id="buscar">

    <div class="cabeceraFormulario">
    
        <img src="imagenes/viceCityLogo.png" width="250px">
     
      </div>

  <form action="resultados.php" method="GET" class="formulario" id="formulario">

     <div class="bg-slider" id="slider-a"></div>
     <div class="bg-slider" id="slider-b"></div>

   <h2 data-i18n="form.title">Encuentra tu oasis</h2>
    <fieldset>

      </div>


      <!-- Zona/Ubicación -->
      <select id="zona" name="zona">
        <option value="" data-i18n-opt="form.zona">Location</option>
        <option value="Ocean Beach">Ocean Beach</option>
        <option value="Washington Beach">Washington Beach</option>
        <option value="Vice Point">Vice Point</option>
        <option value="Downtown">Downtown</option>
        <option value="Little Havana">Little Havana</option>
        <option value="Little Haiti">Little Haiti</option>
        <option value="Starfish Island">Starfish Island</option>
        <option value="Prawn Island">Prawn Island</option>
        <option value="Vice Port">Vice Port</option>
        <option value="Leaf Links">Leaf Links</option>
      </select>

      <!-- Tipo de Inmueble -->
      <select id="tipoDeInmueble" name="tipo_inmueble">
        <option value="" data-i18n-opt="form.tipo">Property type</option>
        <option value="Casa">Casa</option>
        <option value="Edificio">Edificio</option>
        <option value="Local">Local</option>
        <option value="Garage">Garage</option>
      </select>

      <!-- Habitaciones -->
      <select id="habitaciones" name="habitaciones">
        <option value="" data-i18n-opt="form.habitaciones">Bedrooms</option>
        <option value="1">1+</option>
        <option value="2">2+</option>
        <option value="3">3+</option>
        <option value="4">4+</option>
        <option value="6">6+</option>
        <option value="8">8+</option>
      </select>

      <!-- Precio Mínimo -->
      <select id="precio_min" name="precio_min">
        <option value="" data-i18n-opt="form.precio_min">Min. price</option>
        <option value="0">$0</option>
        <option value="5000">$5,000</option>
        <option value="10000">$10,000</option>
        <option value="50000">$50,000</option>
        <option value="100000">$100,000</option>
        <option value="250000">$250,000</option>
        <option value="500000">$500,000</option>
      </select>

      <!-- Precio Máximo -->
      <select id="precio_max" name="precio_max">
        <option value="" data-i18n-opt="form.precio_max">Max. price</option>
        <option value="10000">$10,000</option>
        <option value="50000">$50,000</option>
        <option value="100000">$100,000</option>
        <option value="250000">$250,000</option>
        <option value="500000">$500,000</option>
        <option value="1000000">$1,000,000</option>
        <option value="2000000">$2,000,000+</option>
      </select>

      <!-- Fecha de Construcción -->
      <select id="fecha_construccion" name="año_min">
        <option value="" data-i18n-opt="form.anio">Built after</option>
        <option value="1975">1975+</option>
        <option value="1978">1978+</option>
        <option value="1980">1980+</option>
        <option value="1982">1982+</option>
        <option value="1984">1984+</option>
      </select>
       
    </fieldset>

    <div class="pieFormulario">
          <label>
            <input type="checkbox" name="amueblada" value="1"><span data-i18n="form.amueblada">Furnished only</span>
          </label>
            <button type="submit" data-i18n="form.boton">SEARCH</button>
        </div>
 
  </form>
</section>
<!-- FIN SECCIÓN FORMULARIO -->

<!-- SECCIÓN HOT PROPERTIES -->
<section class="hotPropertiesContainer">
  <h1 data-i18n="hot.title">HOT PROPERTIES</h1>
  <div class="hotProperties" id="properties">
    
    <?php
    require_once 'config/conexion.php';

    $query = "SELECT p.*, prop.nombre as propietario_nombre 
              FROM propiedades p 
              JOIN propietarios prop ON p.propietario_id = prop.id 
              ORDER BY p.precio DESC 
              LIMIT 4";
    $stmt = $pdo->query($query);
    $destacadas = $stmt->fetchAll();
    ?>

    <?php if (empty($destacadas)): ?>
      <p class="no-results">No hay propiedades disponibles.</p>
    <?php else: ?>
      <?php foreach ($destacadas as $prop): ?>
        <div class="hotSection">
          <div class="hotSectionTop">
            <img src="<?php echo htmlspecialchars($prop['imagen']); ?>" alt="<?php echo htmlspecialchars($prop['titulo']); ?>">
            <h2><?php echo htmlspecialchars($prop['titulo']); ?></h2>
            <h3><?php echo htmlspecialchars($prop['zona']); ?></h3>
            <p>$<?php echo number_format($prop['precio'], 0, '.', ','); ?></p>
          </div>

          <div class="buttonContainer">
            
            <button data-i18n="hot.ver" onclick="window.location.href='detalle.php?id=<?php echo $prop['id']; ?>'">VIEW DETAILS</button>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>
</section>
<!-- FIN HOT PROPERTIES -->

<!-- SECCIÓN ABOUT -->
<section id="about" class="about-section">
     <div class="about-container">

    <!-- COLUMNA IZQUIERDA: Foto -->
    <div class="about-image-col">
      <div class="about-image-frame">
        <div class="about-image-glow"></div>
        <img
          src="imagenes/tomyVercetti74.png"
          alt="Tommy Vercetti - Fundador de Vercetti Properties"
          class="about-photo"
        />
        <div class="about-image-badge">
          <span class="badge-year">EST.</span>
          <span class="badge-number">1986</span>
        </div>
      </div>
    </div>

    <!-- COLUMNA DERECHA: Texto -->
    <div class="about-text-col">
      <div class="about-label" data-i18n="about.label">Founder & CEO</div>
      <h2 class="about-title">
        Vercetti<br/>
        <span class="about-title-accent">Properties</span>
      </h2>

      <div class="about-divider">
        <span></span><span class="diamond">◆</span><span></span>
      </div>

      <blockquote class="about-quote" data-i18n="about.quote">
        "En Vice City aprendí que todo el mundo quiere un pedazo del paraíso.<br/>
        Yo solo me encargué de que ese pedazo tuviera buenas vistas."
      </blockquote>

      <p class="about-bio" data-i18n="about.bio1">
        Tommy Vercetti llegó a Vice City en 1986 sin nada más que una maleta y
        una deuda pendiente. Lo que nadie esperaba es que en
        menos de un año controlaría cada esquina de la ciudad.
      </p>

      <p class="about-bio" data-i18n="about.bio2">
        El <strong>Pole Position Club</strong>, el <strong>Sunshine Autos</strong>,
        el <strong>Malibu Club</strong>, la mansión Diaz... cada propiedad que Tommy
        adquirió fue el primer ladrillo de lo que hoy es <strong>Vercetti Properties</strong>.
        Porque Tommy siempre supo que el verdadero poder en esta ciudad no está
        en las armas — está en los títulos de propiedad.
      </p>

      <p class="about-bio" data-i18n="about.bio3">
        A sus <strong>74 años</strong>, Tommy sigue al frente de la empresa.
        Ya no cierra tratos en garajes ni en muelles a medianoche.
        Ahora lo hace desde una oficina con vistas al océano,
        exactamente como siempre quiso.
      </p>
      
      <div class="about-stats">
        <div class="stat-item">
          <span class="stat-number">+30</span>
          <span class="stat-label" data-i18n="about.stat1">Properties</span>
        </div>
        <div class="stat-divider">|</div>
        <div class="stat-item">
          <span class="stat-number">39</span>
          <span class="stat-label" data-i18n="about.stat2">Years of experience</span>
        </div>
        <div class="stat-divider">|</div>
        <div class="stat-item">
          <span class="stat-number">1</span>
          <span class="stat-label" data-i18n="about.stat3">City. Vice City.</span>
        </div>
        <div class="stat-divider">|</div>
        <div class="stat-item">
            <span class="stat-number" data-i18n="about.stat4">Coming Soon..</span>
          <span class="stat-label">Liberty City</span>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- FIN ABOUT -->

<!--SECCIÓN CONTACTO -->

<section id="contact" class="contacto-section">

  <div class="contacto-inner">
    
    <!-- TÍTULO -->
    <!--<h2 class="contacto-title">Contacto</h2>-->
    <p class="contacto-subtitle" data-i18n="contact.subtitle">¿Interesado en una propiedad? Tommy le atiende personalmente.</p>
    
    <div class="contactoFondo">
    <!-- TRES ITEMS EN FILA -->
    <div class="contacto-items">

      <div class="contacto-item">
        <span class="contacto-label" data-i18n="contact.phone">Phone</span>
        <a href="tel:+1305000000" class="contacto-link">+1 (305) 000-0000</a>
      </div>
      <div class="contacto-item">
        <span class="contacto-label" data-i18n="contact.email">Email</span>
        <a href="mailto:tommy@vercettiproperties.com" class="contacto-link">tommy@vercettiproperties.com</a>
      </div>
      <div class="contacto-item">
        <span class="contacto-label" data-i18n="contact.office">Office</span>
        <span class="contacto-link">Ocean Drive 1986, Starfish Island · Vice City</span>
      </div>

    </div>
  </div>
    <!-- FOOTER -->
    <p class="contacto-footer" data-i18n="contact.legal"><em>Todas las propiedades son de adquisición totalmente legítima.</em></p>
  </div>

</section>
  <?php include 'footer.php'; ?>
 <script src="scripts.js"></script>
 <script src="translations.js"></script> 
</body>
</html>