Ext.define('sisscsj.view.opciones.AmbitoMonitoreoPc.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.ambitomonitoreopc.edit.form',
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
                            name: 'fk_id_caracteristica_monitoreo_pc',
                            fieldLabel: 'Característica:',
                            displayField: 'nombre_caracteristica_monitoreo_pc',
                            valueField: 'id_caracteristica_monitoreo_pc',
                            store: {
                                type: 'opciones.caracteristicamonitoreopc'
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
                            name: 'estado_ambito_monitoreo_pc',
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
                            name: 'nombre_ambito_monitoreo_pc',
                            fieldLabel: 'Nombre de Ámbito',
                            allowBlank: true
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'indicador_ambito_monitoreo_pc',
                            fieldLabel: 'Indicador de Ámbito',
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