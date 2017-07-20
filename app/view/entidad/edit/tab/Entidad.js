Ext.define('sisscsj.view.entidad.edit.tab.Entidad', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.entidad.edit.tab.entidad',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Información de Entidad</strong>',
                    defaults: {
                        layout: 'hbox',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Nombre de Entidad:',
                                    name: 'nombre_entidad'
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_tipo_entidad',
                                    fieldLabel: 'Tipo de Entidad:',
                                    displayField: 'nombre_tipo_entidad',
                                    valueField: 'id_tipo_entidad',
                                    store: {
                                        type: 'opciones.tipoentidad'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_inicio_actividades_entidad',
                                    fieldLabel: 'Fecha de Inicio',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d'
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_fin_actividades_entidad',
                                    fieldLabel: 'Fecha de Fin',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'direccion_entidad',
                                    fieldLabel: 'Dirección de Entidad',
                                    height: 100
                                },
                                {
                                    xtype: 'textareafield',
                                    name: 'observaciones_entidad',
                                    fieldLabel: 'Observaciones',
                                    height: 100
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
})