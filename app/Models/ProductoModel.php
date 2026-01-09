<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class ProductoModel extends Model
{
    protected $table      = 'cat_productos';
    protected $primaryKey = 'id_producto';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nom_producto','id_categoria','id_subcategoria','id_medida',
        'precio_unitario','descripcion','foto','clave','activo',
        'id_color','id_posicion','id_caracter','id_signo','id_terminado',
        'ejemplo','new'
    ];

    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    /* ========================= LISTA ========================= */

    public function lista($activo = "", $categoria = 0, $subcategoria = 0)
    {
        $builder = $this->db->table('cat_productos cp')
            ->select('
                cp.nom_producto, cp.id_producto, cp.activo,
                cc.id_categoria, cc.nom_categoria,
                cs.id_subcategoria, cs.nom_subcategoria,
                descripcion,
                cm.id_medida, cm.largo, cm.ancho, cm.unidad,
                precio_unitario, cp.foto, cp.clave, cp.new
            ')
            ->join('cat_categorias cc', 'cp.id_categoria = cc.id_categoria')
            ->join('cat_subcategorias cs', 'cp.id_subcategoria = cs.id_subcategoria')
            ->join('cat_medidas cm', 'cp.id_medida = cm.id_medida');

        if ($activo !== "") {
            $builder->where('cp.activo', $activo);
        }
        if ($categoria != 0) {
            $builder->where('cp.id_categoria', $categoria);
        }
        if ($subcategoria != 0) {
            $builder->where('cp.id_subcategoria', $subcategoria);
        }

        $builder->orderBy('cp.id_producto', 'DESC');

        return $builder->get()->getResultArray();
    }

    /* ========================= BUSCA ========================= */

    public function busca($idProducto = 0)
    {
        if ($idProducto == 0) {
            return INVALID_REQUEST;
        }

        $builder = $this->db->table('cat_productos cp')
            ->select('
                cp.*, cc.nom_categoria, cs.nom_subcategoria,
                cm.largo, cm.ancho, cm.unidad
            ')
            ->join('cat_categorias cc', 'cp.id_categoria = cc.id_categoria')
            ->join('cat_subcategorias cs', 'cp.id_subcategoria = cs.id_subcategoria')
            ->join('cat_medidas cm', 'cp.id_medida = cm.id_medida')
            ->where('cp.id_producto', $idProducto);

        $row = $builder->get()->getRowArray();
        if (!$row) {
            return null;
        }

        /* ---- Colores ---- */
        $colores = [];
        if (!empty($row['id_color'])) {
            foreach (explode(',', $row['id_color']) as $color) {
                $colorRow = $this->db->table('cat_colores')
                    ->select('id_color, color, hex')
                    ->where(['activo' => 1, 'id_color' => $color])
                    ->get()->getRowArray();
                if ($colorRow) {
                    $colores[] = $colorRow;
                }
            }
        }

        /* ---- Posiciones ---- */
        $posiciones = [];
        $arrPos = !empty($row['id_posicion']) ? explode(',', $row['id_posicion']) : [0];
        $arrCar = !empty($row['id_caracter']) ? explode(',', $row['id_caracter']) : [0];

        if ($arrPos === [0]) {
            $fuentes = [];
            $caracteres = [];

            foreach ($arrCar as $car) {
                $c = $this->db->table('cat_caracteres')
                    ->where(['activo' => 1, 'id_caracter' => $car])
                    ->get()->getRowArray();
                if ($c) {
                    $fuentes[] = $c['id_fuente'];
                    $caracteres[] = $c['caracteres'];
                }
            }

            $posiciones[] = [
                'id_posicion' => 4,
                'numero_posicion' => 4,
                'id_fuente_linea_1' => implode(',', $fuentes),
                'caracteres_linea_1' => implode(',', $caracteres),
                'id_fuente_linea_2' => null,
                'caracteres_linea_2' => null,
                'id_fuente_linea_3' => null,
                'caracteres_linea_3' => null,
            ];
        } else {
            foreach ($arrPos as $pos) {
                $p = $this->db->table('cat_posiciones')
                    ->where(['activo' => 1, 'id_posicion' => $pos])
                    ->get()->getRowArray();
                if ($p) {
                    $posiciones[] = [
                        'id_posicion' => $p['id_posicion'],
                        'numero_posicion' => $p['numero_posicion'],
                        'id_renglon' => $p['id_renglon'],
                        'id_fuente_linea_1' => $p['id_fuente_linea1'],
                        'id_fuente_linea_2' => $p['id_fuente_linea2'],
                        'id_fuente_linea_3' => $p['id_fuente_linea3'],
                        'caracteres_linea_1' => $p['caracter1'],
                        'caracteres_linea_2' => $p['caracter2'],
                        'caracteres_linea_3' => $p['caracter3'],
                    ];
                }
            }
        }

        return [
            'nom_producto' => $row['nom_producto'],
            'id_producto' => $row['id_producto'],
            'descripcion' => $row['descripcion'],
            'nom_categoria' => $row['nom_categoria'],
            'id_categoria' => $row['id_categoria'],
            'nom_subcategoria' => $row['nom_subcategoria'],
            'id_subcategoria' => $row['id_subcategoria'],
            'precio_unitario' => $row['precio_unitario'],
            'foto' => $row['foto'],
            'clave' => $row['clave'],
            'activo' => $row['activo'],
            'colores' => $colores,
            'posiciones' => $posiciones,
            'signos' => explode(',', $row['id_signo']),
            'id_terminado' => $row['id_terminado'],
            'ejemplo' => $row['ejemplo'],
            'new' => $row['new'],
            'resena' => $this->busca_resena($idProducto)
        ];
    }

    /* ========================= RESEÑAS ========================= */

    public function busca_resena($idProducto)
    {
        $builder = $this->db->table('plap_t_resenas a')
            ->select('a.*, b.nombres, b.paterno')
            ->join('plap_t_info_usuarios b', 'a.id_user = b.id_user')
            ->where('a.id_producto', $idProducto)
            ->orderBy('a.fecha_add', 'DESC');

        $rows = $builder->get()->getResultArray();
        return count($rows) ? $rows : null;
    }

    /* ========================= STATUS ========================= */

    public function cambia_status($idProducto, $estatus)
    {
        $producto = $this->find($idProducto);

        if (!$producto) {
            return ['Code' => NO_RESULTS];
        }

        $this->update($idProducto, ['activo' => $estatus]);

        return [
            'Code' => QUERY_SUCCESS,
            'Msg'  => ($estatus == 1)
                ? "Se activó el producto {$producto['nom_producto']}"
                : "Se desactivó el producto {$producto['nom_producto']}"
        ];
    }

    /* ========================= DESCUENTOS ========================= */

    public function lista_descuentos()
    {
        return $this->db->table('cat_descuentos')
            ->where('activo', 1)
            ->orderBy('rango_inicio, id_categoria', 'ASC')
            ->get()->getResultArray();
    }

    public function lista_precios_base()
    {
        $rows = $this->db->table('cat_descuentos')
            ->where(['activo' => 1, 'descuento' => 0])
            ->get()->getResultArray();

        $out = [];
        foreach ($rows as $r) {
            $out[$r['id_categoria']] = $r['precio_final'];
        }
        return $out;
    }
}
