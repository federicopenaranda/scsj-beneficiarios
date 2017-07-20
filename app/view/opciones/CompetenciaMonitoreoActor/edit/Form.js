Ext.define('sisscsj.view.opciones.CompetenciaMonitoreoActor.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.competenciamonitoreoactor.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            defaults: {
                layout: 'hbox',
                margins: '0 10 0 10'
            },
            items: [
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_tipo_monitoreo_actor',
                            fieldLabel: 'Tipo de Monitoreo:',
                            displayField: 'nombre_tipo_monitoreo_actor',
                            valueField: 'id_tipo_monitoreo_actor',
                            store: {
                                type: 'opciones.tipomonitoreoactor'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'combo',
                            name: 'estado_competencia_monitoreo_actor',
                            fieldLabel: 'Estado:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data : [['Activo', 1],['Inactivo', 0]]
                            }),
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }                        
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textfield',
                            name: 'nombre_competencia_monitoreo_actor',
                            fieldLabel: 'Nombre de Competencia',
                            allowBlank: true
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'descripcion_competencia_monitoreo_actor',
                            fieldLabel: 'Descripción de Competencia',
                            height: 200,
                            allowBlank: true
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});