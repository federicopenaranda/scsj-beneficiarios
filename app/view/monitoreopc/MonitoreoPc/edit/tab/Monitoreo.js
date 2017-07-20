Ext.define('sisscsj.view.monitoreopc.MonitoreoPc.edit.tab.Monitoreo', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreopc.ponitoreopc.edit.tab.monitoreo',
    layout: 'form',
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
                            name: 'fk_id_lugar_actividad',
                            fieldLabel: 'Lugar:',
                            displayField: 'nombre_lugar_actividad',
                            valueField: 'id_lugar_actividad',
                            store: {
                                type: 'opciones.lugar'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'datefield',
                            name: 'fecha_monitoreo_punto_comunitario',
                            fieldLabel: 'Fecha',
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
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_usuario_responsable',
                            fieldLabel: 'Usuario Responsable:',
                            displayTpl: Ext.create('Ext.XTemplate',
                                        '<tpl for=".">',
                                            '{nombre_usuario} {apellido_usuario}',
                                        '</tpl>'),
                            tpl: '<tpl for="."><div class="x-boundlist-item" >{nombre_usuario} {apellido_usuario}</div></tpl>',
                            valueField: 'id_usuario',
                            store: {
                                type: 'usuario.usuario'
                            },
                            editable: true,
                            forceSelection: true,
                            allowBlank: false,
                            typeAhead: true,
                            triggerAction: 'all',
                            minChars : 1,
                            totalProperty : 'total',
                            pageSize : 10,
                            listeners: {
                                beforequery: function( queryPlan, eOpts ) {
                                    var nQuery = [];
                                    var tmpQuery = {
                                        nombre_usuario: queryPlan.query,
                                        apellido_usuario: queryPlan.query
                                    };
                                    nQuery.push(tmpQuery); // push this to the array
                                    queryPlan.query = Ext.encode(nQuery);
                                }
                            }
                        }                     
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'analisis_monitoreo_punto_comunitario',
                            fieldLabel: 'Análisis de Monitoreo',
                            height: 300,
                            allowBlank: true
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});