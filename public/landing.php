<?php
require_once __DIR__ . '/../app/helpers.php';
$config = require __DIR__ . '/../app/config.php';
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($config['app']['name']) ?> · Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?= url('/assets/css/app.css') ?>" rel="stylesheet">
</head>
<body class="landing-body">
  <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
      <a class="navbar-brand fw-semibold" href="<?= url('/public/landing.php') ?>">
        <i class="bi bi-stars text-primary me-2"></i><?= h($config['app']['name']) ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="landingNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#colecciones">Colecciones</a></li>
          <li class="nav-item"><a class="nav-link" href="#beneficios">Beneficios</a></li>
          <li class="nav-item"><a class="nav-link" href="#experiencia">Experiencia</a></li>
          <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
        </ul>
        <a class="btn btn-outline-primary ms-lg-3" href="<?= url('/public/login.php') ?>">Ingresar</a>
      </div>
    </div>
  </nav>

  <header class="landing-hero">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-12 col-lg-6">
          <span class="badge rounded-pill text-bg-light border mb-3">Nueva temporada · 2026</span>
          <h1 class="display-5 fw-semibold">Viste tu esencia con una boutique hecha para ti.</h1>
          <p class="lead text-muted">Descubre prendas exclusivas, asesoría personalizada y entregas cuidadas. Todo pensado para que vivas una experiencia única desde la primera visita.</p>
          <div class="d-flex flex-wrap gap-3">
            <a class="btn btn-primary btn-lg" href="#colecciones">Explorar colecciones</a>
            <a class="btn btn-outline-secondary btn-lg" href="#contacto">Agenda una cita</a>
          </div>
          <div class="d-flex align-items-center gap-4 mt-4 text-muted small">
            <div><i class="bi bi-truck me-2"></i>Envíos en 24/48h</div>
            <div><i class="bi bi-shield-check me-2"></i>Pagos seguros</div>
            <div><i class="bi bi-award me-2"></i>Ediciones limitadas</div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="landing-hero-card">
            <div class="landing-hero-card__accent"></div>
            <div class="p-4 p-md-5">
              <h3 class="fw-semibold">Lo más vendido</h3>
              <p class="text-muted">Prendas seleccionadas por estilistas con stock limitado cada semana.</p>
              <div class="row g-3">
                <div class="col-6">
                  <div class="mini-card">
                    <span class="mini-card__label">Vestidos</span>
                    <strong class="d-block">Siluetas fluidas</strong>
                    <span class="text-muted small">Desde $59</span>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mini-card">
                    <span class="mini-card__label">Accesorios</span>
                    <strong class="d-block">Brillo sutil</strong>
                    <span class="text-muted small">Desde $19</span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mini-card highlight">
                    <span class="mini-card__label">Personal shopper</span>
                    <strong class="d-block">Asesoría 1:1</strong>
                    <span class="text-muted small">Reserva tu cita sin costo</span>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3 mt-4">
                <div class="avatar-stack">
                  <span class="avatar"></span>
                  <span class="avatar"></span>
                  <span class="avatar"></span>
                </div>
                <div>
                  <div class="fw-semibold">+1,200 clientas felices</div>
                  <div class="text-muted small">Calificación promedio 4.9/5</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section id="colecciones" class="landing-section">
    <div class="container">
      <div class="d-flex flex-wrap align-items-end justify-content-between mb-4 gap-2">
        <div>
          <h2 class="fw-semibold">Colecciones destacadas</h2>
          <p class="text-muted">Tonos neutros, tejidos ligeros y cortes modernos para cada ocasión.</p>
        </div>
        <a class="btn btn-outline-dark" href="#contacto">Solicitar catálogo</a>
      </div>
      <div class="row g-4">
        <div class="col-12 col-md-4">
          <div class="collection-card">
            <div class="collection-card__tag">Office chic</div>
            <h5>Elegancia para diario</h5>
            <p class="text-muted">Blazers suaves, pantalones de tiro alto y camisas de seda.</p>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="collection-card">
            <div class="collection-card__tag">Weekend</div>
            <h5>Relax con estilo</h5>
            <p class="text-muted">Denim premium, básicos con textura y sets versátiles.</p>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="collection-card">
            <div class="collection-card__tag">Eventos</div>
            <h5>Brillo sofisticado</h5>
            <p class="text-muted">Vestidos largos, accesorios con brillo y tonos joya.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="beneficios" class="landing-section landing-section--muted">
    <div class="container">
      <div class="row g-4">
        <div class="col-12 col-lg-5">
          <h2 class="fw-semibold">Beneficios que enamoran</h2>
          <p class="text-muted">Transformamos cada visita en una experiencia. Desde la selección del look hasta el empaque final.</p>
          <ul class="list-unstyled benefit-list">
            <li><i class="bi bi-heart-fill"></i> Asesoría personalizada con estilistas expertos.</li>
            <li><i class="bi bi-bag-check-fill"></i> Cambios rápidos y sin complicaciones.</li>
            <li><i class="bi bi-gift-fill"></i> Presentación premium en cada compra.</li>
          </ul>
        </div>
        <div class="col-12 col-lg-7">
          <div class="row g-3">
            <div class="col-12 col-md-6">
              <div class="feature-card">
                <i class="bi bi-phone"></i>
                <h6>Compra omnicanal</h6>
                <p class="text-muted">Reserva online y recoge en tienda cuando prefieras.</p>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="feature-card">
                <i class="bi bi-stars"></i>
                <h6>Ediciones limitadas</h6>
                <p class="text-muted">Lanzamientos semanales con piezas únicas.</p>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="feature-card">
                <i class="bi bi-person-check"></i>
                <h6>Club Boutique</h6>
                <p class="text-muted">Acumula puntos y desbloquea experiencias VIP.</p>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="feature-card">
                <i class="bi bi-geo-alt"></i>
                <h6>Entrega express</h6>
                <p class="text-muted">Servicio inmediato en zonas seleccionadas.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="experiencia" class="landing-section">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-12 col-lg-6">
          <div class="experience-card">
            <h3 class="fw-semibold">Tu estilo, tu ritmo</h3>
            <p class="text-muted">Agenda una visita privada para descubrir combinaciones únicas, recibir asesoría y disfrutar de un café de cortesía.</p>
            <div class="d-flex flex-wrap gap-3 mt-4">
              <div class="experience-pill"><i class="bi bi-calendar-event"></i> Agenda flexible</div>
              <div class="experience-pill"><i class="bi bi-cup-hot"></i> Espacio lounge</div>
              <div class="experience-pill"><i class="bi bi-lightning"></i> Ajustes express</div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="testimonial-card">
            <div class="d-flex align-items-center gap-3">
              <div class="testimonial-avatar">LM</div>
              <div>
                <div class="fw-semibold">Laura M.</div>
                <div class="text-muted small">Clienta frecuente</div>
              </div>
            </div>
            <p class="mt-3">“Siempre encuentro algo especial. El equipo entiende lo que necesito y me ayuda a crear looks completos en minutos.”</p>
            <div class="text-warning">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contacto" class="landing-section landing-section--cta">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-12 col-lg-6">
          <h2 class="fw-semibold">¿Lista para tu próximo look?</h2>
          <p class="text-white-50">Escríbenos y coordinemos tu visita o solicita recomendaciones personalizadas.</p>
        </div>
        <div class="col-12 col-lg-6">
          <div class="cta-card">
            <form class="row g-3">
              <div class="col-12">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" placeholder="Tu nombre">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" placeholder="tu@email.com">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Teléfono</label>
                <input class="form-control" type="tel" placeholder="+34 600 123 456">
              </div>
              <div class="col-12">
                <label class="form-label">Cuéntanos qué buscas</label>
                <textarea class="form-control" rows="3" placeholder="Estilo, talla, ocasión..."></textarea>
              </div>
              <div class="col-12 d-grid">
                <button class="btn btn-primary btn-lg" type="button">Enviar solicitud</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="landing-footer">
    <div class="container">
      <div class="row g-4">
        <div class="col-12 col-md-6">
          <h5 class="fw-semibold"><?= h($config['app']['name']) ?></h5>
          <p class="text-muted">Moda consciente, asesoría cercana y piezas que celebran tu estilo.</p>
        </div>
        <div class="col-12 col-md-3">
          <h6 class="text-uppercase text-muted">Boutique</h6>
          <ul class="list-unstyled">
            <li><a href="#colecciones">Colecciones</a></li>
            <li><a href="#beneficios">Beneficios</a></li>
            <li><a href="#experiencia">Experiencia</a></li>
          </ul>
        </div>
        <div class="col-12 col-md-3">
          <h6 class="text-uppercase text-muted">Síguenos</h6>
          <div class="d-flex gap-3">
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
            <a href="#" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
          </div>
        </div>
      </div>
      <div class="border-top mt-4 pt-3 text-muted small">© <?= date('Y') ?> <?= h($config['app']['name']) ?>. Todos los derechos reservados.</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
