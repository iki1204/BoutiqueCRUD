<?php

declare(strict_types=1);

class VentasController extends BaseController
{
    private VentaModel $ventaModel;
    private ClienteModel $clienteModel;
    private EmpleadoModel $empleadoModel;
    private ProductoModel $productoModel;

    public function __construct()
    {
        $this->ventaModel = new VentaModel();
        $this->clienteModel = new ClienteModel();
        $this->empleadoModel = new EmpleadoModel();
        $this->productoModel = new ProductoModel();
    }

    public function index(): void
    {
        $this->render('ventas/index', [
            'ventas' => $this->ventaModel->getAll(),
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $payload = $this->getVentaPayload();
            $detalles = $this->getDetallePayload();
            $payload['TOTAL'] = $this->calcularTotal($detalles);
            $this->ventaModel->create($payload, $detalles);
            $this->redirect('/ventas');
        }

        $this->render('ventas/form', [
            'title' => 'Nueva venta',
            'action' => '/ventas/crear',
            'venta' => null,
            'detalles' => [],
            'clientes' => $this->clienteModel->getAll(),
            'empleados' => $this->empleadoModel->getAll(),
            'productos' => $this->productoModel->getAll(),
        ]);
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/ventas');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $payload = $this->getVentaPayload();
            $detalles = $this->getDetallePayload();
            $payload['TOTAL'] = $this->calcularTotal($detalles);
            $this->ventaModel->update($id, $payload, $detalles);
            $this->redirect('/ventas');
        }

        $venta = $this->ventaModel->getById($id);
        if (!$venta) {
            $this->redirect('/ventas');
        }

        $this->render('ventas/form', [
            'title' => 'Editar venta',
            'action' => '/ventas/editar/' . $id,
            'venta' => $venta,
            'detalles' => $venta['DETALLE'] ?? [],
            'clientes' => $this->clienteModel->getAll(),
            'empleados' => $this->empleadoModel->getAll(),
            'productos' => $this->productoModel->getAll(),
        ]);
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->ventaModel->delete($id);
        }
        $this->redirect('/ventas');
    }

    private function getVentaPayload(): array
    {
        return [
            'CLIENTE_ID' => (int) ($_POST['CLIENTE_ID'] ?? 0),
            'EMPLEADO_ID' => (int) ($_POST['EMPLEADO_ID'] ?? 0),
            'FECHA' => $_POST['FECHA'] ?? date('Y-m-d H:i:s'),
            'TOTAL' => 0,
            'ESTADO' => trim((string) ($_POST['ESTADO'] ?? '')),
            'METODO_PAGO' => trim((string) ($_POST['METODO_PAGO'] ?? '')),
        ];
    }

    private function getDetallePayload(): array
    {
        $productos = $_POST['DETALLE_PRODUCTO_ID'] ?? [];
        $cantidades = $_POST['DETALLE_CANTIDAD'] ?? [];
        $precios = $_POST['DETALLE_PRECIO'] ?? [];
        $detalles = [];

        foreach ($productos as $index => $productoId) {
            $productoId = (int) $productoId;
            $cantidad = (int) ($cantidades[$index] ?? 0);
            $precio = (float) ($precios[$index] ?? 0);

            if ($productoId > 0 && $cantidad > 0) {
                $detalles[] = [
                    'PRODUCTO_ID' => $productoId,
                    'CANTIDAD' => $cantidad,
                    'PRECIO' => $precio,
                ];
            }
        }

        return $detalles;
    }

    private function calcularTotal(array $detalles): float
    {
        $total = 0.0;
        foreach ($detalles as $detalle) {
            $total += $detalle['CANTIDAD'] * $detalle['PRECIO'];
        }

        return $total;
    }
}
