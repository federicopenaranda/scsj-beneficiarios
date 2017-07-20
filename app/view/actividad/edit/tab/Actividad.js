Ext.define('sisscsj.view.actividad.edit.tab.Actividad', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.actividad.edit.tab.actividad',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Información de Actividad</strong>',
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
                                    fieldLabel: 'Título de Actividad:',
                                    name: 'titulo_actividad',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_lugar_actividad',
                                    fieldLabel: 'Lugar de Actividad:',
                                    displayField: 'nombre_lugar_actividad',
                                    valueField: 'id_lugar_actividad',
                                    allowBlank: false,
                                    store: {
                                        type: 'opciones.lugar'
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
                                    name: 'fecha_inicio_actividad',
                                    fieldLabel: 'Fecha de Inicio',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_fin_actividad',
                                    fieldLabel: 'Fecha de Fin',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d',
                                    allowBlank: false
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'descripcion_actividad',
                                    fieldLabel: 'Descripción de Actividad',
                                    height: 150,
                                    allowBlank: false
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});