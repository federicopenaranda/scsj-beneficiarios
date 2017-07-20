Ext.define('sisscsj.view.actividad.ListaPersonal', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.actividad.listapersonal',
    title: 'Participantes de la Actividad. <i>(0 Usuarios seleccionados)</i>',
    bodyPadding: 0,
    columnLines: true,
    selType: 'checkboxmodel',
    multiSelect: true,
    viewConfig: {
        emptyText: 'No hay datos.'
    },
    store: 'Usuario',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_usuario',
                        flex: 1
                    },
                    {
                        text: 'Apellido',
                        dataIndex: 'apellido_usuario',
                        flex: 1
                    },
                    {
                        text: 'Login',
                        dataIndex: 'login_usuario',
                        flex: 1
                    },
                    {
                        text: 'Celular',
                        dataIndex: 'celular_usuario',
                        flex: 1
                    }
                ]
            }
        });
        me.callParent(arguments);
    }
})