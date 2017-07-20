Ext.define('sisscsj.view.actividad_proyecto.edit.tab.ActividadProyecto', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.actividad_proyecto.edit.tab.actividadproyecto',
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
                    title: '<strong>Información de Actividad de Proyecto</strong>',
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
                                    fieldLabel: 'Título de Actividad de Proyecto:',
                                    name: 'titulo_actividad_proyecto',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_lugar_actividad',
                                    fieldLabel: 'Lugar de Actividad de Proyecto:',
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
                                    name: 'fecha_inicio_actividad_proyecto',
                                    fieldLabel: 'Fecha de Inicio',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_fin_actividad_proyecto',
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
                                    name: 'descripcion_actividad_proyecto',
                                    fieldLabel: 'Descripción de Actividad de Proyecto',
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