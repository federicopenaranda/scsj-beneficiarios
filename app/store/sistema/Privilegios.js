Ext.define('sisscsj.store.sistema.Privilegios', {
    extend: 'Ext.data.Store',
    alias: 'store.sistema.privilegios',
    storeId: 'Privilegios',
    fields: ['nombre', 'valor'],
    data : [
        {"nombre":"menu.opciones", "valor": (sisscsj.util.Utilities.tipoUsuario == 'admin') ? false : true },
        {"nombre":"menu.gestiones", "valor": (sisscsj.util.Utilities.tipoUsuario == 'admin') ? false : true },
        {"nombre":"menu.actividades", "valor": (sisscsj.util.Utilities.tipoUsuario == 'admin') ? false : true },
        {"nombre":"menu.asistencia", "valor": (sisscsj.util.Utilities.tipoUsuario == 'admin') ? false : true },
        {"nombre":"menu.usuarios", "valor": (sisscsj.util.Utilities.tipoUsuario == 'admin') ? false : true },
        {"nombre":"menu.entidades", "valor": (sisscsj.util.Utilities.tipoUsuario == 'admin') ? false : true },
        {"nombre":"menu.reportes", "valor": (sisscsj.util.Utilities.tipoUsuario == 'admin') ? false : true },
        {"nombre":"menu.beneficiarios", "valor": false }
    ]
});