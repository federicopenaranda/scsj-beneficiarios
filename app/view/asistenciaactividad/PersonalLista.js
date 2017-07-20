Ext.define('sisscsj.view.asistenciaactividad.PersonalLista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.asistenciaactividad.personallista',
    bodyPadding: 0,
    columnLines: true,
    selType: 'checkboxmodel',
    multiSelect: true,
    viewConfig: {
        emptyText: 'No hay datos.'
    },
    initComponent: function() {

        var storeEstadoAsistencia = Ext.data.StoreManager.lookup('opciones.EstadoAsistencia');
        storeEstadoAsistencia.load();

        var me = this;
        me.cellEditing = new Ext.grid.plugin.CellEditing({
            clicksToEdit: 1
        });
        Ext.applyIf(me, {
            selModel: {
                selType: 'cellmodel'
            },
            plugins: [me.cellEditing],
            columns: {
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Nombre',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_usuario' ) + ' ' + record.get( 'apellido_usuario' );
                        },
                        flex: 1
                    },
                    {
                        text: 'Login',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'login_usuario' );
                        },
                        flex: 1
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'fk_id_estado_asistencia',
                        flex: 1,
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_estado_asistencia',
                            displayField: 'nombre_estado_asistencia',
                            valueField: 'id_estado_asistencia',
                            store: {
                                type: 'opciones.estadoasistencia'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        renderer: function (valor){
                            if (valor !== null && valor !== '' && valor !== 0 )
                            {
                                var intIndice = storeEstadoAsistencia.find('id_estado_asistencia', valor);
                                var objRegistro = storeEstadoAsistencia.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_estado_asistencia');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return (valor === 0) ? '' : valor;
                            }
                        }
                    }
                ]
            }
        });
        me.callParent(arguments);
    }
});