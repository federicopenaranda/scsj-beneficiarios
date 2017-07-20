Ext.define('sisscsj.view.opciones.CriterioMonitoreoActor.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.criteriomonitoreoactor.edit.form',
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
                            name: 'fk_id_competencia_monitoreo_actor',
                            fieldLabel: 'Competencia:',
                            displayField: 'nombre_competencia_monitoreo_actor',
                            valueField: 'id_competencia_monitoreo_actor',
                            store: {
                                type: 'opciones.competenciamonitoreoactor'
                            },
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'combo',
                            name: 'estado_criterio_monitoreo_actor',
                            fieldLabel: 'Estado:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data : [['Activo', 1],['Inactivo', 0]]
                            }),
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
                            name: 'nombre_criterio_monitoreo_actor',
                            fieldLabel: 'Nombre de Criterio',
                            allowBlank: false
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'descripcion_criterio_monitoreo_actor',
                            fieldLabel: 'Descripción de Criterio',
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