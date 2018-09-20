<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        |----------------------------------------------------------------------
        | General
        |----------------------------------------------------------------------
        |
        */

        /**
         * Usuarios
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'usuarios.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Ver detalle de un usuario',
            'slug'          => 'usuarios.show',
            'description'   => 'Ve en detalle cada usuario del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'usuarios.edit',
            'description'   => 'Permite editar cualquier dato de un usuario del sistema',
        ]);

        /**
         * Administrativos
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar administrativos',
            'slug'          => 'administrativos.index',
            'description'   => 'Lista y navega todos los administrativos del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Ver detalle de un administrativo',
            'slug'          => 'administrativos.show',
            'description'   => 'Ve en detalle cada administrativo del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de administrativos',
            'slug'          => 'administrativos.create',
            'description'   => 'Permite crear nuevos administrativos en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de administrativos',
            'slug'          => 'administrativos.edit',
            'description'   => 'Permite editar cualquier dato de un administrativo del sistema',
        ]);

        /**
         * Docentes
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar docentes',
            'slug'          => 'docentes.index',
            'description'   => 'Lista y navega todos los docentes del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Ver detalle de un docente',
            'slug'          => 'docentes.show',
            'description'   => 'Ve en detalle cada docente del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de docentes',
            'slug'          => 'docentes.create',
            'description'   => 'Permite crear nuevos docentes en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de docentes',
            'slug'          => 'docentes.edit',
            'description'   => 'Permite editar cualquier dato de un docente del sistema',
        ]);

        /**
         * Planeamientos
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar planeaciones',
            'slug'          => 'planeamientos.index',
            'description'   => 'Lista y navega todos las planeaciones del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Ver detalle de una planeación',
            'slug'          => 'planeamientos.show',
            'description'   => 'Ve en detalle cada planeación del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de planeaciones',
            'slug'          => 'planeamientos.create',
            'description'   => 'Permite crear nuevas planeaciones en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de planeaciones',
            'slug'          => 'planeamientos.edit',
            'description'   => 'Permite editar cualquier dato de una planeación del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Eliminar planeaciones',
            'slug'          => 'planeamientos.destroy',
            'description'   => 'Permite eliminar cualquier planeación del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Descargar planeaciones',
            'slug'          => 'planeamientos.download',
            'description'   => 'Permite descargar el documento de cualquier planeación del sistema',
        ]);

        /**
         * Practicantes
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar practicantes',
            'slug'          => 'practicantes.index',
            'description'   => 'Lista y navega todos los practicantes del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Ver detalle de un practicante',
            'slug'          => 'practicantes.show',
            'description'   => 'Ve en detalle cada practicante del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de practicantes',
            'slug'          => 'practicantes.create',
            'description'   => 'Permite crear nuevos practicantes en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de practicantes',
            'slug'          => 'practicantes.edit',
            'description'   => 'Permite editar cualquier dato de un practicante del sistema',
        ]);

        /**
         * Seguimientos
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar seguimientos',
            'slug'          => 'seguimientos.index',
            'description'   => 'Lista y navega todos los seguimientos del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Ver detalle de un seguimiento',
            'slug'          => 'seguimientos.show',
            'description'   => 'Ve en detalle cada seguimiento del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de seguimientos',
            'slug'          => 'seguimientos.create',
            'description'   => 'Permite crear nuevos seguimientos en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de seguimientos',
            'slug'          => 'seguimientos.edit',
            'description'   => 'Permite editar cualquier dato de un seguimiento del sistema',
        ]);

        /**
         * Galerias
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar galerias',
            'slug'          => 'galerias.index',
            'description'   => 'Lista y navega todas los galerias del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de galerias',
            'slug'          => 'galerias.create',
            'description'   => 'Permite crear nuevas galerias en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de galerias',
            'slug'          => 'galerias.edit',
            'description'   => 'Permite editar cualquier dato de una galeria del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Eliminar galerias',
            'slug'          => 'galerias.destroy',
            'description'   => 'Permite eliminar cualquier galeria del sistema',
        ]);

        /**
         * Calendarios
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar calendarios',
            'slug'          => 'calendarios.index',
            'description'   => 'Lista y navega todas los calendarios del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de calendarios',
            'slug'          => 'calendarios.create',
            'description'   => 'Permite crear nuevas calendarios en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de calendarios',
            'slug'          => 'calendarios.edit',
            'description'   => 'Permite editar cualquier dato de un calendario del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Eliminar calendarios',
            'slug'          => 'calendarios.destroy',
            'description'   => 'Permite eliminar cualquier calendario del sistema',
        ]);

        /**
         * Eventos
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar eventos',
            'slug'          => 'eventos.index',
            'description'   => 'Lista y navega todos los eventos del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Ver detalle de un evento',
            'slug'          => 'eventos.show',
            'description'   => 'Ve en detalle cada evento del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de eventos',
            'slug'          => 'eventos.create',
            'description'   => 'Permite crear nuevos eventos en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de eventos',
            'slug'          => 'eventos.edit',
            'description'   => 'Permite editar cualquier dato de un evento del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Eliminar eventos',
            'slug'          => 'eventos.destroy',
            'description'   => 'Permite eliminar cualquier evento del sistema',
        ]);

        /*
        |----------------------------------------------------------------------
        | Configuración
        |----------------------------------------------------------------------
        |
        */

        /**
         * Fechas
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar fechas',
            'slug'          => 'fechas.index',
            'description'   => 'Lista y navega todos los fechas del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Ver detalle de un fecha',
            'slug'          => 'fechas.show',
            'description'   => 'Ve en detalle cada fecha del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de fechas',
            'slug'          => 'fechas.create',
            'description'   => 'Permite crear nuevos fechas en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de fechas',
            'slug'          => 'fechas.edit',
            'description'   => 'Permite editar cualquier dato de un fecha del sistema',
        ]);

        /*
        |----------------------------------------------------------------------
        | Seguridad
        |----------------------------------------------------------------------
        |
        */

        /**
         * Bitácoras
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar bitacoras',
            'slug'          => 'bitacoras.index',
            'description'   => 'Lista y navega todos las bitacoras del sistema',
        ]);

        /**
         * Roles
         */
        factory(Permission::class)->create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'roles.show',
            'description'   => 'Ve en detalle cada rol del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Permite crear nuevos roles en el sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Permite editar cualquier dato de un rol del sistema',
        ]);

        factory(Permission::class)->create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Permite eliminar cualquier rol del sistema',
        ]);

    }
}
