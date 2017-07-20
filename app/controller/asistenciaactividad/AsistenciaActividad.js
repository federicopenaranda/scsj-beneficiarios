Ext.define('sisscsj.controller.asistenciaactividad.AsistenciaActividad', {
    extend: 'sisscsj.controller.Base',
    boolAsistenciaEdit: 0,
    stores: [
        'asistenciaactividad.AsistenciaActividad',
        'asistenciaactividad.AsistenciaBeneficiario',
        'asistenciaactividad.AsistenciaPersonal'
    ],
    views: [
        'asistenciaactividad.BeneficiariosLista',
        'asistenciaactividad.PersonalLista',
        'asistenciaactividad.edit.AsistenciaForm',
        'asistenciaactividad.edit.Form',
        'asistenciaactividad.edit.Window',
        'asistenciaactividad.edit.tab.Asistencia',
        'asistenciaactividad.edit.tab.Beneficiarios',
        'asistenciaactividad.edit.tab.Personal'
    ],
    refs: [
        {
            ref: 'ActividadLista',
            selector: '[xtype=actividad.lista]'
        },
        {
            ref: 'AsistenciaWindow',
            selector: '[xtype=asistenciaactividad.edit.window]'
        },
        {
            ref: 'AsistenciaForm',
            selector: '[xtype=asistenciaactividad.edit.form]'
        },
        {
            ref: 'AsistenciaTabForm',
            selector: '[xtype=asistenciaactividad.edit.asistenciaform]'
        },
        {
            ref: 'AsistenciaBeneficiariosLista',
            selector: '[xtype=asistenciaactividad.beneficiarioslista]'
        },
        {
            ref: 'AsistenciaPersonalLista',
            selector: '[xtype=asistenciaactividad.personallista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=actividad.lista] button#asistencia': {
                    click: this.add
                },
                'window[xtype=asistenciaactividad.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=asistenciaactividad.edit.window] button#cancel': {
                    click: this.close
                },
                'grid[xtype=asistenciaactividad.beneficiarioslista]': {
                    beforerender: this.loadRecords
                },
                'grid[xtype=asistenciaactividad.personallista]': {
                    beforerender: this.loadRecords
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    

    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        // clear any fliters that have been applied
        store.clearFilter(true);
        // load the store
        store.load();
    },
    


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.asistenciaactividad.AsistenciaActividad');
        
        me.boolAsistenciaEdit = 0;
        
        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getAsistenciaLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        if ( !form.isValid() )
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
        Ext.getBody().mask('Guardando Asistencia ...');
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


    showEditWindow: function(record) {
        var me = this,
                win = me.getAsistenciaWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('asistenciaactividad.edit.window', {
                title: isNew ? 'Crear Asistencia' : 'Editar Asistencia'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    }


});