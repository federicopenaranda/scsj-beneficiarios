Ext.define('sisscsj.view.actividad.ListaBeneficiarios', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.actividad.listabeneficiarios',
    title: 'Participantes de la Actividad. <i>(0 Beneficiarios seleccionados)</i>',
    bodyPadding: 0,
    columnLines: true,
    selType: 'checkboxmodel',
    multiSelect: true,
    viewConfig: {
        emptyText: 'No hay datos.'
    },
    /* [INICIO] Variables adicionales */
    entornoFamiliar: false,
    /* [FIN] Variables adicionales */
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
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'primer_nombre_beneficiario' ) + ' ' + record.get( 'apellido_paterno_beneficiario' );
                        },
                        flex: 1
                    },
                    {
                        text: 'Código',
                        dataIndex: 'codigo_beneficiario',
                        flex: 1
                    },
                    {
                        text: 'Código Familia',
                        dataIndex: 'codigo_beneficiario',
                        flex: 1
                    },
                    {
                        text: 'Edad',
                        dataIndex: 'codigo_beneficiario',
                        flex: 1
                    },
                    {
                        text: 'Entidad',
                        dataIndex: 'codigo_beneficiario',
                        flex: 1
                    }
                ]
            },
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    ui: 'footer',
                    items: [
                        '<strong>¿Registrar al Entorno Familiar?</strong>', 
                        {
                            xtype: 'checkbox',
                            hideLabel: true,
                            id: 'entornofamiliar'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
})