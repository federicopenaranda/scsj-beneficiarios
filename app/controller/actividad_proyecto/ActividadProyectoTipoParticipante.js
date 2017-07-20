Ext.define('sisscsj.controller.actividad_proyecto.ActividadProyectoTipoParticipante', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'actividad_proyecto.ActividadTipoParticipante'
    ],
    views: [
        'actividad_proyecto.Lista',
        'actividad_proyecto.actividad_tipo_participante.Lista',
        'actividad_proyecto.actividad_tipo_participante.edit.Form',
        'actividad_proyecto.actividad_tipo_participante.edit.WindowActividadTipoParticipante'
    ],
    refs: [
        {
            ref: 'ActividadProyectoTipoParticipanteLista',
            selector: '[xtype=actividad_proyecto.actividad_tipo_participante.lista]'
        },
        {
            ref: 'ActividadProyectoTipoParticipanteWindow',
            selector: '[xtype=actividad_proyecto.actividad_tipo_participante.edit.window]'
        },
        {
            ref: 'ActividadProyectoTipoParticipanteWindowActividadTipoParticipante',
            selector: '[xtype=actividad_proyecto.actividad_tipo_participante.edit.windowactividadtipoparticipante]'
        },
        {
            ref: 'ActividadProyectoLista',
            selector: '[xtype=actividad_proyecto.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=actividad_proyecto.lista] button#asistencia_actividad_proyecto': {
                    click: this.add
                },
                'grid[xtype=actividad_proyecto.actividad_tipo_participante.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.editTipoParticipante,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=actividad_proyecto.actividad_tipo_participante.lista] button#add': {
                    click: this.addTipoParticipante
                },
                'grid[xtype=actividad_proyecto.actividad_tipo_participante.lista] button#edit': {
                    click: this.editTipoParticipante
                },
                'grid[xtype=actividad_proyecto.actividad_tipo_participante.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=actividad_proyecto.actividad_tipo_participante.edit.windowactividadtipoparticipante] button#save': {
                    click: this.save
                },
                'window[xtype=actividad_proyecto.actividad_tipo_participante.edit.windowactividadtipoparticipante] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    
    
    add: function( view, record, item, index, e, eOpts ) {
        var me = this;
        
        var grid = me.getActividadProyectoLista();
        var record = grid.getSelectionModel().getSelection()[0];

        // show window
        me.showEditWindow(record);
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getActividadProyectoTipoParticipanteWindow();

        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('actividad_proyecto.actividad_tipo_participante.edit.window', {
                title: 'Asistencia de Actividad'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    addTipoParticipante: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.actividad_proyecto.ActividadTipoParticipante');

        // show window
        me.showEditWindowTipoParticipante(record);
    },
    
    showEditWindowTipoParticipante: function(record) {
        var me = this,
                win = me.getActividadProyectoTipoParticipanteWindowActividadTipoParticipante(),
                isNew = record.phantom;
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('actividad_proyecto.actividad_tipo_participante.edit.windowactividadtipoparticipante', {
                title: isNew ? 'Añadir Tipo de Participante' : 'Editar Tipo de Participante'
            });
        }
      
        // show window
        win.show();
        
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getActividadProyectoLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },
    

    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        // clear any fliters that have been applied
        store.clearFilter(true);
        
        var grid2 = me.getActividadProyectoLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();
        
        store.filter( "fk_id_actividad_proyecto", data['id_actividad_proyecto'] );
    },


    editTipoParticipante: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getActividadProyectoLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show window
        me.showEditWindowTipoParticipante(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getActividadProyectoTipoParticipanteLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        if ( form.isValid() )
        {
            var gridActividadProyecto = me.getActividadProyectoLista();
            var recordActividadProyecto = gridActividadProyecto.getSelectionModel().getSelection()[0];
            var dataActividadProyecto = recordActividadProyecto.getData();

            values['fk_id_actividad_proyecto'] = dataActividadProyecto['id_actividad_proyecto'];
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }

        // set values of record from form
        record.set(values);
        
        // check if form is even dirty...if not, just close window and stop everything...nothing to see here
        if (!record.dirty) {
            win.close();
            return;
        }
        // setup generic callback config for create/save methods
        callbacks = {
            success: function(records, operation) {
                store.reload();
                win.close();
            },
            failure: function(records, operation) {
                // if failure, reject changes in store
                store.rejectChanges();
            }
        };
        // mask to prevent extra submits
        Ext.getBody().mask('Guardando Tipo de Participante ...');
        // if new record...
        if (record.phantom) {
            // reject any other changes
            store.rejectChanges();
            // add the new record
            store.add(record);
        }
        // persist the record
        store.sync(callbacks);
    },
            

    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;

        var grid = me.getActividadProyectoTipoParticipanteLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar este Tipo de Participante?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
            if (buttonId === 'yes') {
                store.remove(record);
                store.sync({
                    failure: function(records, operation) {
                        store.rejectChanges();
                    }
                });
            }
        });
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    }


});